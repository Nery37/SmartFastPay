<?php

declare(strict_types=1);

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $methods = [
            ['name' => 'Boleto Bancário', 'slug' => 'billet', 'fee' => 2.0],
            ['name' => 'PIX', 'slug' => 'pix', 'fee' => 1.5],
            ['name' => 'Transferência Bancária', 'slug' => 'bank_transfer', 'fee' => 4.0]
        ];

        foreach ($methods as $index => $item) {
            DB::table('payment_methods')->insertOrIgnore(
                [
                    'id' => $index + 1,
                    'name' => $item['name'],
                    'slug' => $item['slug'],
                    'fee' => $item['fee'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]
            );
        }
    }
}
