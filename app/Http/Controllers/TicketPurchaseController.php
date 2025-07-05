<?php

namespace App\Http\Controllers;

use App\Models\Concert;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketPurchaseController extends Controller
{
    public function store(Request $request, $concertId)
    {
        $concert = Concert::findOrFail($concertId);
        $request->validate([
            'jumlah' => 'required|integer|min:1|max:' . $concert->stok_tiket,
        ]);
        if ($concert->stok_tiket < $request->jumlah) {
            return back()->with('error', 'Stok tiket tidak mencukupi.');
        }
        // Kurangi stok
        $concert->stok_tiket -= $request->jumlah;
        $concert->save();
        // Simpan transaksi
        $trx = new Transaction();
        $trx->user_id = Auth::id();
        $trx->concert_id = $concert->id;
        $trx->jumlah = $request->jumlah;
        $trx->total_price = $concert->harga * $request->jumlah;
        $trx->status = 'Pending';
        $trx->save();
        return redirect()->route('mytickets')->with('success', 'Pembelian tiket berhasil!');
    }
}