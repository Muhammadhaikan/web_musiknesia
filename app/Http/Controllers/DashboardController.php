<?php

namespace App\Http\Controllers;

use App\Models\Concert;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function index()
    {
        return view("dashboard", [
            "concerts" => Concert::all()
        ]);
    }
}
