<?php

namespace Database\Seeders;

use App\Http\Controllers\Admin\ClientController;
use App\Models\Audio;
use App\Models\Category;
use App\Models\Client;
use App\Models\EducationalLevel;
use App\Models\Gender;
use App\Models\Level;
use App\Models\Phase;
use App\Models\Program;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use DB;
class FakeClientAccounts extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // $this->createClientGeneral();
        //$this->paymentGeneral(131);
        //$this->listenAllAudiosGeneral(131);
        //$this->createTeacher();
        //$this->paymentLifefullness(126);
       // $this->listenAllAudiosTeacher(126);
        //$this->createStudent();
        $this->listenAllAudiosTeacher(210,[Category::LIFE_FULLNESS_PRIMARY]);
        //$this->createHospital();
    }

    function createClientGeneral(){
        DB::table('clients')->insert([
            //GENERAL
            [
                'id' => 131,
                'name' => 'GENERAL',
                'last_name' => 'TEST',
                'second_last_name' => 'MAY',
                'email' => 'general16052023@gmail.com',
                'password' => env('APP_DEBUG')?bcrypt('prueba123'):Hash::make('UUA-L1F3FU1LN3SS@'),
                'active' => true,
                'age' => 18,
                'created_at' => Carbon::now(),
                'updated_at' =>Carbon::now(),
                'gender_id' => Gender::ANOTHER,
                'program_id' => Program::RECOGNITIONS_PROGRAM
            ]]);
    }
    function createTeacher(){
        DB::table('clients')->insert([
            //GENERAL
            [
                'id' => 126,
                'name' => 'Teacher',
                'last_name' => 'TEST',
                'second_last_name' => 'MAY',
                'email' => 'teacher03052023@lifefullness.com',
                'password' => env('APP_DEBUG')?bcrypt('prueba123'):Hash::make('UUA-L1F3FU1LN3SS@'),
                'active' => true,
                'age' => 18,
                'teacher'=>true,
                'created_at' => Carbon::now(),
                'updated_at' =>Carbon::now(),
                'gender_id' => Gender::ANOTHER,
                'program_id' => Program::LIFEFULLNESS
            ]]);

        ClientController::setFreeLifefullnessAudios(Client::find(126));
    }
    function createStudent(){
        DB::table('clients')->insert([
            //GENERAL
            [
                'id' => 127,
                'name' => 'PRIMARIA',
                'last_name' => 'TEST',
                'second_last_name' => 'MAY',
                'email' => 'primaria03052023@lifefullness.com',
                'password' => env('APP_DEBUG')?bcrypt('prueba123'):Hash::make('UUA-L1F3FU1LN3SS@'),
                'active' => true,
                'age' => 18,
                'teacher'=>false,
                'educational_level_id'=>EducationalLevel::PRIMARY,
                'created_at' => Carbon::now(),
                'updated_at' =>Carbon::now(),
                'gender_id' => Gender::ANOTHER,
                'program_id' => Program::LIFEFULLNESS
            ]]);
        ClientController::setFreeLifefullnessAudios(Client::find(126));
    }

    function createHospital(){
        DB::table('clients')->insert([
            //GENERAL
            [
                'id' => 128,
                'name' => 'COMPANY',
                'last_name' => 'HOSPITAL',
                'second_last_name' => 'MAY',
                'email' => 'company03052023@lifefullness.com',
                'password' => env('APP_DEBUG')?bcrypt('prueba123'):Hash::make('UUA-L1F3FU1LN3SS@'),
                'active' => true,
                'age' => 18,
                'teacher'=>false,
                'created_at' => Carbon::now(),
                'updated_at' =>Carbon::now(),
                'gender_id' => Gender::ANOTHER,
                'program_id' => Program::LIFE_FULLNESS_HEALTH
            ]]);
    }

    function paymentGeneral($clientId){
        $phases=Phase::whereCategoryId(Category::RECOGNITIONS_PROGRAM)->get();
        foreach ($phases as $phase){
            DB::table('payments')->insert([
                //Recognitions Programs
                [
                    'date' => Carbon::now(),
                    'payment_method' => 'Paypal',
                    'price' => $phase->price,
                    'active' => true,
                    'audios_id' => null,
                    'phase_id' => $phase->id,
                    'client_id' => $clientId,
                    'programs_id' => Program::RECOGNITIONS_PROGRAM,
                    'created_at'=>Carbon::now()
                ]]);
        }
    }

    function paymentLifefullness($clientId,$categories=Category::LIFEFULLNESS){
        $audios=Audio::whereHas('phase.category',function ($q) use($categories){
            $q->whereIn('id',$categories);
        })->get();
        foreach ($audios as $audio){
            DB::table('payments')->insert([
                //Recognitions Programs
                [
                    'date' => Carbon::now(),
                    'payment_method' => 'Paypal',
                    'price' => $audio->price,
                    'active' => true,
                    'audios_id' => $audio->id,
                    'phase_id' => null,
                    'client_id' => $clientId,
                    'programs_id' => Program::LIFEFULLNESS,
                ]]);
        }
    }

    function listenAllAudiosGeneral($clientId){
        $audios=Audio::whereHas('phase.category',function ($q){
            $q->whereIn('id',[Category::RECOGNITIONS_PROGRAM,Category::MEDITATIONS_GUIDED]);
        })->get();

        foreach ($audios as $audio){
            DB::table('client_audio')->insert([
                ['client_id' => $clientId, 'audios_id' => $audio->id, 'completed' => 1]]);
        }
    }

    function listenAllAudiosTeacher($clientId,$categories=Category::LIFEFULLNESS){
        $audios=Audio::whereHas('phase.category',function ($q) use($categories){
            $q->whereIn('id',$categories);
        })->get();

        foreach ($audios as $audio){
            DB::table('client_audio')->insert([
                ['client_id' => $clientId, 'audios_id' => $audio->id, 'completed' => 1]]);
        }
    }
}
