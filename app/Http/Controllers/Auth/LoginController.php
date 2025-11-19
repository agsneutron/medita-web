<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use DB;

class LoginController extends Controller
{
    public function auth(Request $request)
    {
        $email = $request->get('user');
        $password = $request->get('password');

        $loginData = [
            'email' => $email,
            'password' => $password,
            'role_id' => Role::ADMIN,
            'active' => 1
        ];

        $user = User::where('email', $email)->get();

        if (\Auth::guard('admin')->attempt($loginData, false)) {
            return response()->json([
                "success" => true,
                "message" => "Ok",
                "user" => $user
            ]);
        } else {
            return response()->json([
                "success" => false,
                "message" => "Bad",
            ]);
        }
    }

    public function logout(Request $request)
    {
        \Auth::guard('admin')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->route('admin.login');
    }

    public function reset(Request $request)
    {
        try {
            DB::beginTransaction();
            $changePassword = User::whereEmail($request->email)->first();
            $newPassword = self::code();
            $changePassword->password = Hash::make($newPassword);
            $changePassword->saveOrFail();
            DB::commit();
            self::mail('emails.code_email',['email'=>$request->email, 'password' => $newPassword], $request->email, 'MEDITA | Cambio de contraseña');
            return response()->json([
                'success' => true,
                'message' => 'Correctamente actualizado.'
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage(),
                'line' => $ex->getLine(),
                'file' => $ex->getFile()
            ]);
        }
    }
}
