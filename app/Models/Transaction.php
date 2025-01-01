<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // Jika nama tabel berbeda dari nama model dalam bentuk jamak
    protected $table = 'transactions';

    // Kolom yang diizinkan untuk diisi secara massal
    protected $fillable = [
        'user_id', 'waste_type', 'weight', 'coins',
    ];
}
