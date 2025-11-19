<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->Users();
    }

    public function Users()
    {
        DB::table('users')->insert([
            [
                'name' => 'Administrador',
                'last_name' => 'Administrador',
                'second_last_name' => 'Administrador',
                'email' => 'admin@lifefullness.com',
                'password' => env('APP_DEBUG',true) ? Hash::make('prueba123') : Hash::make('L1F3FU1LN3SS@'),
                'active' => true,
                'role_id' => Role::ADMIN
            ]
        ]);
    }
}
