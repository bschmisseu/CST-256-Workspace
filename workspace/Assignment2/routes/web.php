<?php

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

//Index Page Route
Route::get('/', function () {
    return view('login');
});

Route::get('/login', function () {
    return view('login');
});

Route::post('/doLogin', 'LoginController@loginUser');

Route::get('/loginBlade', function() {
    return view('loginBlade');
});

Route::post('doLoginBlade', 'LoginControllerBlade@loginUser');

Route::get('/loginValidation', function () {
    return view('loginValidation');
});

Route::post('doLoginValidation', 'LoginControllerValidation@loginUser');