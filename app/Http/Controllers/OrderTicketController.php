<?php

namespace App\Http\Controllers;

use App\Models\Concert;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderTicketController extends Controller
{
    public function showForm($concertId)
    {
        $concert = Concert::findOrFail($concertId);
        $user = Auth::user();
        return view('form-pesan-ticket', compact('concert', 'user'));
    }

    public function order(Request $request, $concertId)
    {
        $concert = Concert::findOrFail($concertId);
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $concert->stok_tiket,
            'payment_method' => 'required|in:qris,bri,dana',
        ]);
        if ($concert->stok_tiket < $request->quantity) {
            return back()->with('error', 'Stok tiket tidak mencukupi.');
        }
        // Simpan transaksi dengan status 'pending'
        $trx = new Transaction();
        $trx->user_id = Auth::id();
        $trx->concert_id = $concert->id;
        $trx->jumlah = $request->quantity;
        $trx->total_price = $concert->harga * $request->quantity;
        $trx->status = 'pending';
        $trx->payment_method = $request->payment_method;
        $trx->save();
        // Redirect ke halaman pembayaran sesuai metode
        $total_bayar = 'Rp ' . number_format($trx->total_price, 0, ',', '.');
        $trx_id = $trx->id;
        if ($request->payment_method == 'qris') {
            return view('payment.qris', compact('total_bayar', 'trx_id'));
        } elseif ($request->payment_method == 'bri') {
            return view('payment.bri', compact('total_bayar', 'trx_id'));
        } else {
            return view('payment.dana', compact('total_bayar', 'trx_id'));
        }
    }

    public function processPayment(Request $request, $method, $trx)
    {
        $transaction = Transaction::findOrFail($trx);
        if ($transaction->status !== 'pending') {
            return redirect()->route('mytickets')->with('error', 'Transaksi sudah diproses.');
        }
        // Kurangi stok tiket
        $concert = $transaction->concert;
        if ($concert->stok_tiket < $transaction->jumlah) {
            return redirect()->route('mytickets')->with('error', 'Stok tiket tidak mencukupi.');
        }
        $concert->stok_tiket -= $transaction->jumlah;
        $concert->save();
        // Update status transaksi
        $transaction->status = 'Pending';
        $transaction->save();
        return redirect()->route('mytickets')->with('success', 'Pembayaran berhasil! Tiket sudah masuk ke My Tiket Ku.');
    }
}
