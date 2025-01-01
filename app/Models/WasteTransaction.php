<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WasteTransaction extends Model
{
    use HasFactory;

    // Tentukan kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'user_id',
        'waste_type',
        'weight',
        'coins',
    ];

    // Relasi ke model User (jika menggunakan autentikasi)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
