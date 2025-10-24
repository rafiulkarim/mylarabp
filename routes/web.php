<?php

use App\Http\Controllers\Auth\RegisterController;
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
Route::get('/clear_all', [\App\Http\Controllers\HomeController::class, 'clear_all']);

Route::get('/', [\App\Http\Controllers\RegistrationController::class, 'login'])->name('login');
Route::post('signin', [\App\Http\Controllers\RegistrationController::class, 'signin']);
Route::post('logout', [\App\Http\Controllers\RegistrationController::class, 'logout'])->name('logout');
// Auth::routes();
Route::get('/error', [\App\Http\Controllers\HomeController::class, 'error']);
Route::fallback([\App\Http\Controllers\HomeController::class, 'fallback']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('user', \App\Http\Controllers\UserController::class);
Route::get('my-profile', [\App\Http\Controllers\UserController::class, 'my_profile']);
Route::resource('permission', \App\Http\Controllers\PermissionController::class);
Route::resource('role', \App\Http\Controllers\RoleController::class);
Route::resource('user-type', \App\Http\Controllers\UserTypeController::class);
