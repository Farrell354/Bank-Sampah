<?php
namespace App\Http\Controllers;

use App\Models\WasteTransaction;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $transactions = WasteTransaction::where('user_id', Auth::id())->latest()->get();
        return view('dashboard', compact('transactions'));
    }
}
