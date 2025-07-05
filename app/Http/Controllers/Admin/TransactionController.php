<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{

    public function index(Request $request)
    {
        $query = Transaction::with(['user', 'concert']);

        // Filter tanggal (by date only, not time)
        if ($request->filled('filter_date')) {
            $query->whereDate('created_at', $request->filter_date);
        }

        // Filter status
        if ($request->filled('filter_status')) {
            $query->where('status', $request->filter_status);
        }

        // Search by user name
        if ($request->filled('search_name')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search_name . '%');
            });
        }

        $transactions = $query->orderBy('created_at', 'desc')->paginate(10)->appends($request->all());
        return view('admin.transactions.index', compact('transactions'));
    }

    public function show($id)
    {
        $transaction = Transaction::with(['user', 'concert'])->findOrFail($id);
        return view('admin.transactions.detail', compact('transaction'));
    }

    public function updateStatus(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);
        $request->validate([
            'status' => 'required',
        ]);
        $transaction->status = $request->status;
        $transaction->save();
        return redirect()->route('admin.transactions.index')->with('success', 'Status transaksi diperbarui');
    }
}
