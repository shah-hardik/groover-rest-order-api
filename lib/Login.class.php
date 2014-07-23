<?php

/**
 * User Class
 * 
 * User login
 * 
 * @author DAve Jay
 * @version 1.0
 * @package CRM
 * 
 */
class Login {

    public static function doAdminLogin($user_name, $password) {
        $password = md5($password);
        $query = "select * from admin_users where user_name = '{$user_name}' and password = '{$password}'";
        $user_data = qs($query);
        return $user_data;
    }

    public static function doUserLogin($user_name, $password) {
        $user_data = qs("select * from user_detail where username = '{$user_name}' and password = '{$password}'");
        return $user_data;
    }

}

?>