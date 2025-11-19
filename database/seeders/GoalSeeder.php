<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class GoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('goals')->insert([
            ['id' => 1, 'name' => 'usuarios registrados', 'goal' => 300],
            ['id' => 2, 'name' => 'ventas mensuales', 'goal' => 8000],
            ['id' => 3, 'name' => 'reproducciones', 'goal' => 3000]
        ]);
    }
}
