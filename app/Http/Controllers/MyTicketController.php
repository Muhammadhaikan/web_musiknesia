<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class MyTicketController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('concert')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
        return view('mytickets.index', compact('transactions'));
    }

    public function show($id)
    {
        $trx = Transaction::with('concert')->where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('mytickets.show', compact('trx'));
    }
}
