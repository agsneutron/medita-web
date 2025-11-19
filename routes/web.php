<?php

use App\Http\Controllers\Api\Client\ClientController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*************** ADMIN *********************/
Route::get('/', function () {
    return view('admin.auth.login');
})->name('admin.login');

Route::prefix('auth/')->name('auth.')
    ->group(function () {
        Route::post('login', [LoginController::class,'auth'])
            ->name('login');

        Route::get('logout', [LoginController::class,'logout'])
            ->name('logout');

        Route::post('resetPassword', [LoginController::class,'reset'])
            ->name('reset');
    });

Route::get('password-reset/{token}', [ClientController::class, 'passwordRecoveryView'])->name('password_reset');
Route::post('/new-password', [ClientController::class, 'newPassword'])->name('new_password');

Route::get('/paypal/return', function () {
    $token = request()->query('token') ?? request()->query('orderId');

    if ($token) {
        // Redirige al esquema de tu app móvil
        $url = "nativexo://paypalpay?token=" . urlencode($token);
        return redirect()->away($url);
    }

    return 'No se encontró token de PayPal.';
});

Route::get('/paypal/cancel', function () {
    return 'Pago cancelado por el usuario.';
});
