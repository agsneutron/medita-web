<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Mail;
use Log;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function code(){
        $permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle($permitted_chars), 0, 10);
    }

    public function mail($view,$data,$email,$subject=''){
        try{
            Mail::send($view, $data,
                function ($msj) use ($email,$subject) {
                    $msj->subject($subject);
                    $msj->to($email);
                });
            Log::error('Envío correcto a ' . $email);
        } catch (\Exception $e) {
            Log::error($e->getMessage() . " LINE: " . $e->getLine());
        }

    }

}
