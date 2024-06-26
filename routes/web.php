<?php

use App\Http\Controllers\AdvertsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\DemandNoticeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\InstructionController;
use App\Http\Controllers\FeesController;
use App\Http\Controllers\CommitmentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('login', function () {
    return view('welcome');
})->name('login');

Route::get('forgot_password', function () {
    return view('forgot_password');
})->name('forgot_password');

Route::get('reset_password/{token}', function(string $token){
    return view('reset_password', ['token' => $token]);
})->name('reset_password');

Route::get('/reset-password/{token}', function(string $token){
    return view('reset_password', ['token' => $token]);
})->name('password.reset');

Route::post('login_post', [AuthController::class, 'login_post'])->name('login_post');
Route::post('forgot_pwd_post', [AuthController::class, 'forgot_pwd_post'])->name('forgot_pwd_post');
Route::post('reset-password', [AuthController::class, 'reset_pwd_post'])->name('password.update');

Route::middleware('auth')->group(function(){
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('banks', BankController::class);
    Route::resource('instructions', InstructionController::class);
    Route::resource('payments', PaymentsController::class);
    Route::get('fees', [FeesController::class, 'index'])->name('fees.index');
    Route::resource('commitment', CommitmentController::class);
    Route::resource('demand_notice', DemandNoticeController::class);
    Route::resource('adverts', AdvertsController::class);
});
