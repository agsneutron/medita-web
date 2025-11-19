<?php

namespace Database\Seeders;

use App\Models\Gender;
use App\Models\Program;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use DB;
use Carbon\Carbon;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->clients();
    }

    public function clients()
    {
        DB::table('clients')->insert([
            [
                'name' => 'Medita',
                'last_name' => 'Lifefullness',
                'second_last_name' => 'General',
                'email' => 'general@lifefullness.com',
                'password' => env('APP_DEBUG', true) ? Hash::make('prueba123') : Hash::make('L1F3FU1LN3SS@'),
                'active' => true,
                'age' => 18,
                'created_at' => Carbon::now(),
                'updated_at' =>Carbon::now(),
                'gender_id' => Gender::ANOTHER,
                'program_id' => Program::RECOGNITIONS_PROGRAM
            ]
        ]);
    }
}
