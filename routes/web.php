<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

use App\Http\Controllers\OperacaoController;
use App\Http\Controllers\CarrierController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::middleware(['auth'])->group(function(){
    
    Route::get('/index', function () {
        return view('pages/home');
    });
    // Route::get('/users', [UserController::class, 'index']);
    // Route::get('/users-show', [UserController::class, 'show']);
    // Route::get('/users-create', [UserController::class, 'create']);

    Route::resource('users', UserController::class)->names([
        'users' => 'users.index',
        'show' => 'users.show',
        'create'=> 'users.create',
        'store'=> 'users.store',
        'update'=> 'users.update',
        'destroy' => 'users.destroy',
    ]);
    Route::post('users/{user}/resetpws' , [UserController::class, 'resetpws'])->name('users.resetpws');
    Route::post('users/{user}/resend', [UserController::class, 'resend'])->name('users.resend');
    //Route::post('users/{user}/send-email', [UserController::class, 'sendEmail'])

    Route::resource('clients', ClientController::class)->names([
        'index' => 'clients.index',
        'create' => 'clients.create',
        'store' => 'clients.store',
        'show' => 'clients.show',
        'edit' => 'clients.edit',
        'update' => 'clients.update',
        'destroy' => 'clients.destroy'
    ]);

    Route::resource('carriers', CarrierController::class)->names([
        'index' => 'carriers.index',
        'create' => 'carriers.create',
        'store' => 'carriers.store',
        'show' => 'carriers.show',
        'edit' => 'carriers.edit',
        'update' => 'carriers.update',
        'destroy' => 'carriers.destroy'
    ]);

});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login',  [LoginController::class, 'login']);
Route::post('/logout',  [LoginController::class, 'logout'])->name('logout');

Route::get('/passwordreset',  [ForgotPasswordController::class, 'index']);
Route::post('/passwordreset',  [ForgotPasswordController::class, 'link']);
Route::get('/password/reset',  [ForgotPasswordController::class, 'resetPassword'])->name('password.reset');
Route::post('/resetpassword', [ForgotPasswordController::class, 'reset']);

Route::get('/register',  [RegisterController::class, 'index']);
Route::post('/register',  [RegisterController::class, 'store']);

Route::get('/email/notice',  function(){
    return view('verifyEmail');
})->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function ($id , $hash , Request $request) {
    
    $result = [];
    $user = User::find ($id); 
    
    if (!$user) { 
        $result = [ 'errorUser' => 'Usuário não encontrado.' ]; 
    } 
    else
    if (!hash_equals ((string) $hash , sha1 ( $user->getEmailForVerification ()))) { 
        $result = [ 'errorLink' => 'Link inválido ou expirado.' ]; 
    } 
    else{
        if (!$user->hasVerifiedEmail()) { 
            $user->markEmailAsVerified(); 
        } 
        $result = ["successVerify" => "E-mail verificado com sucesso. Faça login para continuar"];
    }

    return redirect('email/notice')->with($result);

    //return redirect('/login')->with('success', 'E-mail verificado com sucesso!');;
})->name('verification.verify');

Route::get('/main', function () {
    return redirect('index');
});
Route::get('/main2', function () {
    return view('main2');
});

Route::get('/operacoes', [OperacaoController::class, 'index']);
Route::get('/operacao/{id?}', [OperacaoController::class, 'show'])->name("operacao.show");

Route::resource('/transportadoras', TransportadoraController::class);

Route::get('/sessions', function(){
    $data = Session::all();
        // You can now use $data.
    return compact('data');
});
