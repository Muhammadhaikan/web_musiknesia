<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Concert;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        $concertCount = Concert::count();
        $transactionCount = Transaction::count();
        // Akunkan status 'sudah bayar' (bukan 'paid')
        $totalRevenue = Transaction::where('status', 'sudah bayar')->sum('total_price');
        $totalTicketsSold = Transaction::where('status', 'sudah bayar')->sum('jumlah');

        return view('admin.dashboard', compact('userCount', 'concertCount', 'transactionCount', 'totalRevenue', 'totalTicketsSold'));
    }
}
