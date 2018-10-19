<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/23 0023
 * Time: 下午 4:47
 */

Route::group(['middleware'=>'web'],function (){
    Route::any('auth/login', 'Auth\LoginController@login');


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

});
#

