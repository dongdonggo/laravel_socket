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

Route::group([
    'middleware' => 'web',
    'namespace' => 'Auth',
    'prefix' => 'auth'
],function(){
    # custom 客服
    Route::get('/custom/show', 'CustomController@show');
    Route::post('/custom/adminbind', 'CustomController@socketBindAdmin');
    Route::post('/custom/persionbind', 'CustomController@socketBindPerson');
});

Route::get('/xx', function () {
//    return $_SERVER;
//    return view('welcome');
    msgReturn('123');
//    GatewayClient\Gateway::sendToAll(123);
});

Route::get('/testa','TestController@testa');
Route::any('/testva','TestController@testva');

Route::get('/aa', function () {
//    $list = \GatewayClient\Gateway::;
//    dump($list);
//    $user = App\Models\User::where('id',1)->get()->toArray();
//    return  response($user); //$user = \App\User::find(1);
//    return view('welcome');
});
