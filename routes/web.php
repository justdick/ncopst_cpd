<?php

use App\Http\Controllers\CpdController;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\PageantController;
use App\Http\Controllers\PaymentController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
Route::get('/', function () {
    return redirect('/cpd/create');
});

Route::resource('/cpd', CpdController::class );
Route::get('/cpd/confirm', [App\Http\Controllers\CpdController::class, 'checkAdmin'])->name('checkAdmin');

Route::post('/cpd/pay', [PaymentController::class , 'pay'])->name('pay');
Route::post('/pageant/sendotp', [PaymentController::class , 'send_otp'])->name('send_otp');
Route::post('/callback', [PaymentController::class , 'callback'])->name('callback');
Route::post('/payment_status', [PaymentController::class , 'show'])->name('payment_status');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// $user = User::create([
//     'name' => 'admin',
//     'email' => 'admin@email.com',
//     'password' => Hash::make('sd08uhn4e')
// ]);
