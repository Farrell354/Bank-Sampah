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
        $user = auth()->user(); // Dapatkan data pengguna yang sedang login
        $transactions = Transaction::where('user_id', $user->id)->get(); // Transaksi pengguna
        $totalCoins = Transaction::where('user_id', $user->id)->sum('coins'); // Total koin pengguna

        return view('profile.index', compact('user', 'transactions', 'totalCoins'));
    }

    // Mengupdate profil pengguna
    public function edit()
{
    $user = auth()->user(); // Ambil data pengguna yang login
    return view('profile.edit', compact('user')); // Pastikan view 'profile.edit' ada
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
