<?php

/**
 * Admin side Login file
 * 
 * 
 * @author Hardik Shah
 * @version 1.0
 * @package CRM
 * 
 */
$urlArgs = _cg("url_vars");
session_start();
if (isset($_REQUEST['sbt_btn'])) {
    $email = _escape($_REQUEST['email']);
    $password = _escape($_REQUEST['password']);

    $data = Login::doAdminLogin($email, $password);
    $_SESSION['user'] = $data['user_name'];
    if ($data != null) {
        _R('new_orders');
    } else {
        $error = "Username Or Password is Wrong!!!";
    }
}
_cg("page_title", "Login");
?>