<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('clients.home');
});
// auth-login
Route::get('/login', function () {
    return view('auths.login');
});
//auth-register
Route::get('/register', function () {
    return view('auths.register');
});
// auth-forgot-password
Route::get('/forgot-password', function () {
    return view('auths.forgot-password');
});
//auth-get-otp
Route::get('/get-otp', function () {
    return view('auths.get-otp');
});
Route::get('/recovery', function () {
    return view('auths.recovery');
});
// auth-user-info
Route::get('/user-info', function () {
    return view('auths.user-info');
});
// page-notfound
Route::get('403-notfound', function ()  {
    return view('shared.errors.403');
});
Route::get('404-notfound', function ()  {
    return view('shared.errors.404');
});
Route::get('500-notfound', function ()  {
    return view('shared.errors.500');
});
Route::get('502-notfound', function ()  {
    return view('shared.errors.502');
});
Route::get('503-notfound', function ()  {
    return view('shared.errors.503');
});
Route::get('504-notfound', function ()  {
    return view('shared.errors.504');
});


