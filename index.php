<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
require_once 'config.php';
require_once 'lib.php';
$privilege = privilege();

##them
$pattern1 = "/[\x{20}-\x{2E}]/";

if (isset($_GET['action'])) {
    $page = $_GET['action'];
    #them

    // if (preg_match($pattern1, $page)){
    //     echo 'Hack detected';
    // }
    // else{
    //     require_once ("controller/{$page}.php");
    // }
    
    #code chinh
    include ("controller/{$page}.php");

} else {
    if (isset($_GET['admin']) && $privilege != -1) {             //!=-1 -> chưa có khác 0: đã đăng nhập sửa thành ===1
        $page = $_GET['admin'];
        include ("controller/admin/{$page}.php");
        exit();
    }
    require_once ("controller/home.php");
}

?>
