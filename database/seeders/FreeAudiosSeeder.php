<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Program;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use DB;

class FreeAudiosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $audiosFree = Client::freeLifefullnessAudios;
        $audiosFreeTeacher = Client::freeLifefullnessAudiosTeacher;
        $users = DB::table('clients')->get();
        $teachers = DB::table('clients')->where('teacher', 1)->get();
        foreach ($users as $user){
            foreach($audiosFree as $audio){
                if(DB::table('payments')->where('client_id', $user->id)->where('audios_id', $audio)->exists()){
                    continue;
                }
                DB::table('payments')->insert([
                    'client_id' => $user->id,
                    'audios_id' => $audio,
                    'date' => Carbon::today()->format('Y-m-d'),
                    'payment_method' => 'PayPal',
                    'price' => 0,
                    'active' => true,
                    'programs_id' => Program::LIFEFULLNESS,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }
        }
        foreach ($teachers as $teacher){
            foreach($audiosFreeTeacher as $audio){
                if(DB::table('payments')->where('client_id', $teacher->id)->where('audios_id', $audio)->exists()){
                    continue;
                }
                DB::table('payments')->insert([
                    'client_id' => $teacher->id,
                    'audios_id' => $audio,
                    'date' => Carbon::today()->format('Y-m-d'),
                    'payment_method' => 'PayPal',
                    'price' => 0,
                    'active' => true,
                    'programs_id' => Program::LIFEFULLNESS,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }
        }
    }
}
