<?php
/**
 *  系统业务 返回码
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/26 0026
 * Time: 下午 7:02
 */

return [

    /* 用户错误：20001-29999*/
    'USER' => [ //用户方面 错误 ：账户密码错误，修改密码错误
        'user_password_error' => 20001, #账户密码错误
        'user_verificode_error' => 20002, # 密码验证
    ],

    /* 业务错误：30001-39999 */
    //SPECIFIED_QUESTIONED_USER_NOT_EXIST(30001, "某业务出现问题"),
    'BUS' => [
        'bus_fail' => 30001, #操作失败
        //操作失败 30001
        //具体业务模块错误
    ], //业务流程错误

    /* 内部数据错误：50001-599999 */
    'DATA' => [
        'data_notfound' => 50001, # 数据未找到
        'data_error' => 50002, # 数据有误
        'data_already_exists' => 50003,
    ],

    /* 权限错误：70001-79999 */
    'PERMISSION' => [
        'permission_no_access' => 70001, # 权限错误
        'permission_not_fond' => 70002, # 鉴权token 错误
    ],

    /* 接口错误：60001-69999 */
    'INTERFACE' => [
//        ''
    ],
    /*
    INTERFACE_INNER_INVOKE_ERROR(60001, "内部系统接口调用异常"),
    INTERFACE_OUTTER_INVOKE_ERROR(60002, "外部系统接口调用异常"),
    INTERFACE_FORBID_VISIT(60003, "该接口禁止访问"),
    INTERFACE_ADDRESS_INVALID(60004, "接口地址无效"),
    INTERFACE_REQUEST_TIMEOUT(60005, "接口请求超时"),
    INTERFACE_EXCEED_LOAD(60006, "接口负载过高"),
    */

];