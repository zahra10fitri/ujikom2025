<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // INDEX: menampilkan semua user
    public function index()
    {
        $users = User::all();
        return view('admin.user', compact('users'));
    }

    // CREATE: form tambah user
    public function create()
    {
        return view('admin.user-create');
    }

    // STORE: simpan user baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:100',
            'kontak' => 'required|max:13',
            'username' => 'required|max:20|unique:users,username',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,member'
        ]);

        // Set status otomatis
        $status = $request->role === 'admin' ? 'approved' : 'pending';

        // Simpan user baru
        User::create([
            'nama' => $request->nama,
            'kontak' => $request->kontak,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => $status,
        ]);

        return redirect()->route('admin.user')->with('success', 'User berhasil ditambahkan!');
    }

    // EDIT: form edit user
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user-edit', compact('user'));
    }

    // UPDATE: update user + password optional
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'kontak' => 'required|max:13',
            'username' => 'required|max:20|unique:users,username,' . $id,
            'role' => 'required|in:admin,member',
            'status' => 'required|in:pending,approved',
        ]);

        $user = User::findOrFail($id);

        $data = [
            'nama' => $request->nama,
            'kontak' => $request->kontak,
            'username' => $request->username,
            'role' => $request->role,
            'status' => $request->status,
        ];

        // Update password jika diisi
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.user')->with('success', 'User berhasil diperbarui');
    }

    // DELETE: hapus user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.user')->with('success', 'User berhasil dihapus');
    }

    // Menampilkan member pending
    public function pending()
    {
        $members = User::where('role', 'member')
                       ->where('status', 'pending')
                       ->get();

        return view('admin.user-pending', compact('members'));
    }

    // Approve member
    public function approve($id)
    {
        $member = User::findOrFail($id);
        $member->status = 'approved';
        $member->save();

        return redirect()->back()->with('success', 'Member berhasil disetujui.');
    }
}
