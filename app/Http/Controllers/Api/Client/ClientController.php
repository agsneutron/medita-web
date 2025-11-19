<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Client\ClientWS;
use App\Models\Client;
use App\Models\Gender;
use App\Models\PasswordReset;
use App\Models\Program;
use App\Services\StripeService;
use App\Services\UploadFiles;
use Cassandra\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Admin\ClientController as AdminClient;

class ClientController extends Controller
{
    public function login(Request $request)
    {

        try {

            DB::beginTransaction();
            $email = $request->input('email', null);
            $password = $request->input('password', null);

            /** @var Client $client */

            if (isset($email)) $client = Client::whereEmail($email)->first();

            if (!isset($client)) {
                return response()->json([
                    'success' => false,
                    'message' => 'El usuario no se encuentra registrado'
                ]);
            }

            if (!$client->active) {
                return response()->json([
                    'success' => false,
                    'message' => 'El usuario no esta activado, contacte con el administrador'
                ]);
            }

            if (!\Hash::check($password, $client->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'El correo o contraseña son incorrectos'
                ]);
            }

            $token = \Str::random(60);

            $client->api_token = hash('sha256', $token);

            $client->saveOrFail();


            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Inicio de sesión Exito',
                'data' => new ClientWS($client)
            ]);


        } catch (Throwable $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Ocurrio un error al iniciar sesión -> ' . $e->getMessage() . ' LINE -> ' . $e->getLine() . ' FILE -> ' . $e->getFile()
            ]);
        }
    }

    public function loginWithThird(Request $request){
        $name = $request->input('name');
        $last_name = $request->input('last_name');
        $secondLastName = $request->input('second_last_name');
        $email = $request->input('email');
        $thirdId = $request->input('third_id');


        /** @var Client $clientExist */

        $clientExist = Client::whereEmail($email)->orWhere('third_id',$thirdId)->first();

        try {


            DB::beginTransaction();

            if (!isset($clientExist)) {
                if (!isset($email)){
                    return response()->json([
                        'success' => false,
                        'message' => 'No se encontro usuario vuelve a iniciar sessión con la app correspondiente'
                    ]);
                }
                $newClient = new Client();
                $newClient->name = $name;
                $newClient->last_name = $last_name;
                $newClient->second_last_name = $secondLastName;
                $newClient->email = $email;
                $newClient->password = bcrypt($thirdId);
                $newClient->third_id = $thirdId;
                $newClient->age = 18;
                $newClient->gender_id = Gender::ANOTHER;
                $newClient->program_id = Program::RECOGNITIONS_PROGRAM;

                $token = \Str::random(60);

                $newClient->api_token = hash('sha256', $token);


                $newClient->saveOrFail();

                DB::commit();

                return response()->json([
                    'success' => true,
                    'message' => 'Registro Exito',
                    'data' => new ClientWS($newClient)
                ]);
            }


            if (!$clientExist->active) {
                return response()->json([
                    'success' => false,
                    'message' => 'El usuario no esta activado, contacte con el administrador'
                ]);
            }

            if(!isset($clientExist->third_id)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ese correo ya esta registrado, inicia sesion'
                ]);
            }
            if (!\Hash::check($thirdId, $clientExist->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'El correo o contraseña son incorrectos'
                ]);
            }



            $token = \Str::random(60);

            $clientExist->api_token = hash('sha256', $token);

            $clientExist->saveOrFail();


            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Inicio de sesión Exito',
                'data' => new ClientWS($clientExist)
            ]);


        } catch (Throwable $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Ocurrio un error al iniciar sesión'
            ]);
        }
    }

    public function register(Request $request)
    {
        $payload = json_decode($request->get('payload'), true);
        $name = $payload['name'];
        $last_name = $payload['last_name'];
        $second_last_name = $payload['second_last_name'];
        $email = $payload['email'];
        $password = $payload['password'];
        $age = $payload['age'];
        $gender = $payload['gender_id'];
        $phone = $payload['phone'];

        //NO REQUIRED
        $program = isset($payload['program'])?$payload['program']:Program::RECOGNITIONS_PROGRAM;//defualt general
        $teacher = isset($payload['teacher'])?$payload['teacher']:false;
        $institution = isset($payload['institution'])?$payload['institution']:0;
        $educationLevel = isset($payload['educational_level'])?$payload['educational_level']:null;
        $degree = isset($payload['level'])?$payload['level']:null;

        $imageUrl = $request->file('image', null);

        /** @var Client $clientExist */

        $clientExist = Client::whereEmail($email)->first();

        if (isset($clientExist)) {
            return response()->json([
                'success' => false,
                'message' => 'Ya existe un registro con los datos proporcionados',
            ]);
        }

        try {

            DB::beginTransaction();
            $client = new Client();
            $client->name = $name;
            $client->last_name = $last_name;
            $client->second_last_name = $second_last_name;
            $client->email = $email;
            $client->password = bcrypt($password);
            $client->age = $age;
            $client->gender_id = $gender;
            $client->phone = $phone;
            $client->program_id = $program;
            $client->teacher = $teacher;
            $client->active = true;
            if ($imageUrl != null) {
                if (isset($client->url_image)){
                    UploadFiles::deleteFile($client->url_image);
                }
                $nameProfile= uniqid();
                $client->url_image = UploadFiles::uploadFile('lifefullness', $imageUrl, $name.'-'.$nameProfile);
            }

            //ONLY LIFEFULLNESS, LIFE_FULLNESS_HEALTH AND WORK_AND_WELLNESS

            if ($institution != 0) {
                $client->institution_id = $institution;
            }

            //ONLY LIFEFULLNESS

            if ($program == Program::LIFEFULLNESS && !$teacher) {
                $client->educational_level_id = $educationLevel;
                $client->degree = $degree;
            }



            $token = \Str::random(60);

            $client->api_token = hash('sha256', $token);


            $client->saveOrFail();
            if ( $program == Program::LIFEFULLNESS){
                AdminClient::setFreeLifefullnessAudios($client);
            }
            $customer = new \Stripe\Customer();
            $customer->name=$client->name. ' '.$client->last_name.' '.$client->second_last_name;
            $customer->email=$client->email;
            $newCustomer = StripeService::createCustomer($customer);
            $client->stripe_id = $newCustomer->id;
            $client->saveOrFail();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Registro Exito',
                'data' => new ClientWS($client)
            ]);

        } catch (Throwable $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Ocurrio un error al registrar al usuario'
            ]);
        }
    }

    public function modify(Request $request)
    {
        $payload = json_decode($request->get('payload'), true);

        /** @var Client $client */
        $client = \Auth::user();

        $name = $payload['name'];
        $last_name = $payload['last_name'];
        $second_last_name = $payload['second_last_name'];

        $password = isset($payload['password'])?$payload['password']:null;
        $age = $payload['age'];
        $gender = $payload['gender_id'];
        $phone = $payload['phone'];
        $imageUrl = $request->file('image', null);


        try {

            DB::beginTransaction();

            if (!isset($client)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Usuario no encontrado'
                ]);
            }

            $client->name = $name;
            $client->last_name = $last_name;
            $client->second_last_name = $second_last_name;
            if (isset($password) && $password != '' && $password!=null) {
                $client->password = bcrypt($password);
            }
            $client->age = $age;
            $client->gender_id = $gender;
            $client->phone=$phone;

            if ($imageUrl != null) {
                if (isset($client->url_image)){
                    UploadFiles::deleteFile($client->url_image);
                }
                $nameProfile= uniqid();
                $client->url_image = UploadFiles::uploadFile('lifefullness', $imageUrl, $name.'-'.$nameProfile);
            }

            $client->saveOrFail();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Modificación Exitosa',
                'data' => new ClientWS($client)
            ]);
        } catch (Throwable $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Ocurrio un error al registrar al usuario',
                'error'=> $e->getMessage()
            ]);
        }

    }

    public function passwordRecovery(Request $request)
    {

        $email = $request->input('email', null);
        if (!isset($email)) {
            return response()->json([
                'success' => false,
                'message' => 'No se proporcionó un correo'
            ]);
        }

        $user = Client::whereEmail($email)->first();

        if (!isset($user)) {
            return response()->json([
                'success' => false,
                'message' => 'No se encontraron datos con el correo proporcionado'
            ]);
        }


        $passwordReset = new PasswordReset();
        $passwordReset->email = $email;
        $passwordReset->token = str_replace('/', '1', bcrypt(date('Y-m-d H:i:s')));
        $passwordReset->created_at = date('Y-m-d H:i:s');

        DB::beginTransaction();
        try {
            $passwordReset->saveOrFail();
            DB::commit();
            $this->passwordEmail($user->email, $passwordReset->token);

            return response()->json([
                'success' => true,
                'message' => 'El correo de verificación ha sido enviado.'
            ]);
        } catch (Throwable $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Ocurrio un error, intentelo mas tarde'
            ]);
        }

    }

    private function passwordEmail($email, $token)
    {
        try {
            \Mail::send(
                'emails.password_reset',
                ['token' => $token],
                function ($msj) use ($email) {
                    $msj->subject('Lifefullness | Recuperar contraseña');
                    $msj->to($email);
                });
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            dd($e->getMessage());
        }
    }

    public function newPassword(Request $request){

        $email = $request->input('email','');
        $password = $request->input('password','');

        $passwordRecovery = PasswordReset::whereEmail($email)->first();

        if (!isset($passwordRecovery)){
            return response()->json([
                'success' => false,
                'message' => 'No se puedo encontrar la informaciónn de la cuenta',
            ]);
        }

        $customer = Client::whereEmail($email)->first();

        $customer->password = bcrypt($password);

        $customer->save();

        $passwordRecovery = PasswordReset::whereEmail($email);

        $passwordRecovery->delete();

        return response()->json([
            'success' => true,
            'message' => 'Contraseña actualizada',
        ]);

    }

    public function passwordRecoveryView($token){
        $passwordRecovery = PasswordReset::where('token', '=', $token)->first();
        $exist = false;
        $email = '';
        if (isset($passwordRecovery)){
            $exist = true;
            $email = $passwordRecovery->email;
        }

        return view('password_recovery.index',[
            'email'=> $email,
            'exist'=> $exist,
        ]);
    }

    public function removeAccount(){
        try{
            \DB::beginTransaction();
            /** @var Client $client */
            $client = \Auth::user();
            $client->active = false;
            $client->saveOrFail();
            \DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Se eliminó tu cuenta satisfactoriamente',
            ]);
        }catch (\Throwable $exception){
            \DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'No se pudo eliminar tu cuenta',
                'error'=>$exception->getMessage()
            ]);

        }


    }
}
