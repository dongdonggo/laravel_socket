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

Route::get('/ccc/bb', function () {
//    return $_SERVER;
    $a = 'a';
        echo gettype($a);

//    return view('welcome');
});

Route::get('/', function () {
    $user = App\Models\User::where('id',1)->get()->toArray();
    return  response($user); //$user = \App\User::find(1);
//    return view('welcome');
});
