<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'concert_id',
        'jumlah',
        'total_price',
        'status',
        'payment_method',
    ];

    public function concert()
    {
        return $this->belongsTo(Concert::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Ticket dihapus karena tiket sudah tidak digunakan

    /**
     * Get the status label for display.
     */
    public function getStatusLabelAttribute()
    {
        switch ($this->status) {
            case 'sudah bayar':
                return 'Sudah Bayar';
            case 'dibatalkan':
                return 'Dibatalkan';
            default:
                return 'Pending';
        }
    }
}
