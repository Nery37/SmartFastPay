<?php

declare(strict_types=1);

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = ['pending', 'paid', 'expired', 'failed'];

        foreach ($types as $index => $item) {
            DB::table('payment_status')->insertOrIgnore(
                [
                    'id' => $index + 1,
                    'name' => $item,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]
            );
        }
    }
}
