<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/23 0023
 * Time: 下午 4:47
 */

#admin
Route::group([
    'middleware'=>'api',
    'namespace'=>'Admin',
    'prefix'=>'admin'
],function(){
    # dev
    Route::group([
        'namespace'=>'Dev',
        'prefix'=>'dev'
    ],function (){

        # role 角色
        Route::post('/role/create','RoleController@create');
        Route::post('/role/update','RoleController@update');
        Route::post('/role/show', 'RoleController@show');
        Route::post('/role/delete','RoleController@delete');
        Route::post('/role/userrolequery', 'RoleController@userRoleQuery');

        #route 路由添加
        Route::post('/route/create','routeController@create');
        Route::post('/route/update','routeController@update');
        Route::post('/route/show','routeController@show');
        Route::post('/route/delete','routeController@delete');

        #user_roled  给用户分配角色
        Route::post('/userrole/createorupdate','UserRoleController@create');
    });
});