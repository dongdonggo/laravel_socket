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

<<<<<<< HEAD
Route::get('/ccc/bb', function () {
//    return $_SERVER;
    $a = 'a';
        echo gettype($a);

//    return view('welcome');
});
=======
Route::group(['middleware'=>'web'],function (){
    Route::any('auth/login', 'Auth\LoginController@login');
#Auth
    Route::group([
        'namespace' => 'Auth',
        'prefix' => 'auth'
    ],function(){
        # custom 客服
        Route::get('/custom/show', 'CustomController@show')->middleware('adminouth');
        Route::post('/custom/adminbind', 'CustomController@socketBindAdmin')->middleware('adminouth');
        Route::post('/custom/persionbind', 'CustomController@socketBindPerson');
    });
#admin
    Route::group([
        'middleware'=>['adminouth'],
        'namespace'=>'Admin' ,
        'prefix'=>'admin'
    ],function(){

        # dev
        Route::group([
            'namespace'=>'Dev',
            'prefix'=>'dev'
        ],function (){

            # admin_user
            Route::get('users/show', 'AdminController@showAdminUser');
            Route::any('users/adduser', 'AdminController@addAdminUser'); # 添加后台人员
            # role 角色
            Route::get('/roles/show', 'AdminroleController@show');
            Route::any('/roles/create','AdminroleController@create');


            /*Route::post('/role/create','RoleController@create');
            Route::post('/role/update','RoleController@update');

            Route::post('/role/delete','RoleController@delete');
            Route::post('/role/userrolequery', 'RoleController@userRoleQuery');

            #route 路由添加
            Route::post('/route/create','routeController@create');
            Route::post('/route/update','routeController@update');
            Route::post('/route/show','routeController@show');
            Route::post('/route/delete','routeController@delete');

            #user_roled  给用户分配角色
            Route::post('/userrole/createorupdate','UserRoleController@create');*/
        });
    });
>>>>>>> gatewaycommand

});







Route::get('/testa','TestController@testa');
Route::any('/testva','TestController@testva');


