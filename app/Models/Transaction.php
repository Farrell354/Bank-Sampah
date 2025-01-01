<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions'; // Pastikan nama tabel benar
    protected $fillable = ['waste_type', 'weight', 'coins']; // Sesuaikan dengan kolom di tabel
}
