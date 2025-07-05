<?php

namespace App\Http\Controllers;

use App\Models\Concert;
use Illuminate\Http\Request;

class ConcertListController extends Controller
{
    public function index()
    {
        $concerts = Concert::orderBy('tanggal', 'asc')->get();
        return view('concerts.list', compact('concerts'));
    }
}
