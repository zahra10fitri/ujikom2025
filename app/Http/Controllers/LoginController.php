<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // ======================
    // HALAMAN LOGIN
    // ======================
    public function index()
    {
        return view('login');
    }

    // ======================
    // PROSES LOGIN
    // ======================
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {

            $user = Auth::user();

            // CEK STATUS
            if ($user->status !== 'approved') {
                Auth::logout();
                return back()->with('error', 'Akun Anda belum disetujui admin.');
            }

            // CEK ROLE
            if ($user->role == 'admin') {
                return redirect()->route('admin.dashboard');
            }

            if ($user->role == 'member') {
                return redirect()->route('member.dashboard');
            }

            Auth::logout();
            return back()->with('error', 'Role tidak dikenali.');
        }

        return back()->with('error', 'Username atau Password salah!');
    }

    // ======================
    // LOGOUT
    // ======================
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    // ======================
    // HALAMAN REGISTER
    // ======================
    public function register()
    {
        return view('register');
    }

    // ======================
    // PROSES REGISTER
    // ======================
    public function registerproses(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'kontak' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required|min:4',
        ]);

        // BUAT USER DENGAN STATUS PENDING
        User::create([
            'nama'      => $request->nama,
            'kontak'    => $request->kontak,
            'username'  => $request->username,
            'password'  => Hash::make($request->password),
            'role'      => 'member',
            'status'    => 'pending', // WAJIB!
        ]);

        // TIDAK auto login

        return redirect()->route('login')
            ->with('success', 'Registrasi berhasil! Tunggu persetujuan admin sebelum login.');
    }
}
