<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concert extends Model
{
    use HasFactory;

    protected $fillable = ['nama_band', 'lokasi', 'tanggal', 'harga', 'poster', 'stok_tiket'];
    // Relasi ke Ticket dihapus karena tiket sudah tidak digunakan
}
