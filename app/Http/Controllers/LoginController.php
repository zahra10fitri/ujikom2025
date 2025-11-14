<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // Halaman login
    public function index()
    {
        return view('login');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {

            $user = Auth::user();

            // Redirect berdasarkan role
            if ($user->role == 'admin') {
                return redirect()->route('admin.dashboard');
            }
            elseif ($user->role == 'member') {
                return redirect()->route('member.dashboard');
            }
            else {
                Auth::logout();
                return back()->with('error', 'Role tidak dikenali.');
            }
        }

        return back()->with('error', 'Username atau Password salah!');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    // Halaman register
    public function register()
    {
        return view('register');
    }

    // Proses register
    public function registerproses(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'kontak' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required|min:4',
        ]);

        // buat user baru
        $user = User::create([
            'nama'      => $request->nama,
            'kontak'    => $request->kontak,
            'username'  => $request->username,
            'password'  => Hash::make($request->password),
            'role'      => 'member',  // default member
        ]);

        // AUTO LOGIN setelah registrasi
        Auth::login($user);

        // Redirect ke dashboard member
        return redirect()->route('member.dashboard')->with('success', 'Registrasi berhasil, selamat datang!');
    }
}
