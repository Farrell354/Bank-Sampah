<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WasteTransaction;
use Illuminate\Support\Facades\Auth;

class WasteTransactionController extends Controller
{
    // 1. Menampilkan semua transaksi pengguna
    public function index()
{
    $transactions = WasteTransaction::where('user_id', auth()->id())
                     ->orderBy('created_at', 'desc')
                     ->get();

    return view('dashboard', compact('transactions'));
}


    // 2. Menyimpan transaksi baru
    public function store(Request $request)
{
    $validated = $request->validate([
        'waste_type' => 'required|string',
        'weight' => 'required|numeric|min:0.1',
    ]);

    $coins = $this->calculateCoins($validated['weight']);

    WasteTransaction::create([
        'user_id' => auth()->id(), // ID pengguna login
        'waste_type' => $validated['waste_type'],
        'weight' => $validated['weight'],
        'coins' => $coins,
    ]);

    return redirect()->route('dashboard')->with('success', 'Transaksi berhasil disimpan!');
}
    private function calculateCoins($weight)
    {
        // Contoh logika konversi berat ke koin
        return $weight * 10; // 1 kg = 10 koin
    }

    // 3. Menghapus transaksi
    public function destroy($id)
    {
        $transaction = WasteTransaction::findOrFail($id);

        if ($transaction->user_id !== Auth::id()) {
            abort(403, 'Anda tidak diizinkan menghapus transaksi ini.');
        }

        $transaction->delete();

        return redirect()->back()->with('success', 'Transaksi berhasil dihapus.');
    }
}
