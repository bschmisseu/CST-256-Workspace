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

Route::get('/', function () {
    return view('index');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/registration', function () {
    return view('registration');
});

Route::get('/home', function () {
    return view('homePage');
});

Route::post('/loginUser', 'LoginRegistrationController@authenticateUser');

Route::post('/registerUser', 'LoginRegistrationController@registerUser');

Route::get('/logout', 'LoginRegistrationController@logout');

Route::get('/admin', 'AdminController@adminPage');

Route::post('/deleteUser', 'AdminController@deleteUser');

Route::post('/suspendUser', 'AdminController@suspendUser');

Route::get('/profile', function() {
    return view('profile');
});

Route::post('/adminViewUser', 'AdminController@viewUser');

Route::post('/editUser', 'LoginRegistrationController@editUser');
    