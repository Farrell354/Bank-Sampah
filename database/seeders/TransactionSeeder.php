<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Transaction;
class TransactionSeeder extends Seeder
{
    public function run()
    {
        Transaction::create([
            'waste_type' => 'Plastik',
            'weight' => 2.5,
            'coins' => 50,
        ]);
    }
}
