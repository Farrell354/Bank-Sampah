<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;


class ProfileController extends Controller
{
    // Menampilkan halaman profil

    public function index()
    {
        $user = auth()->user(); // Mendapatkan data pengguna yang login
        $transactions = Transaction::all(); // Mendapatkan semua transaksi

        return view('profile.index', compact('user', 'transactions'));
    }

    // Mengupdate profil pengguna
    public function edit()
    {
        $user = Auth::user(); // Ambil data pengguna yang sedang login
        return view('profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui.');
    }
}
