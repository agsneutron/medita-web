<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now();
        $date = $date->format('Y-m-d');

        $price = 1253.43;

        DB::table('payments')->insert([
            [
                'date' => $date,
                'payment_method' => 'Tarjeta de debito',
                'price' => $price,
                'active' => true,
                'audios_id' => 1,
                'client_id' => 1,
                'programs_id' => 2,
            ]
        ]);
    }
}
