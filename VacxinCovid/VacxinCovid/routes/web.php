<?php

use App\Http\Controllers\AuthenticateController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [AuthenticateController::class, 'showLoginForm'])->middleware(['AdminLoggedOut', 'UserLoggedOut']);
Route::post('login', [AuthenticateController::class, 'login']);
Route::get('register', [AuthenticateController::class, 'showRegisterForm']);
Route::post('register', [AuthenticateController::class, 'register']);
Route::get('logout', function () {
    Auth::logout();
    return redirect('login');
});

Route::get('information', [UserController::class, 'allUser'])->middleware('CheckUser');
Route::get('person/{id}', [UserController::class, 'person'])->middleware('CheckUser');
