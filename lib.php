<?php


require_once 'config.php';

function privilege() {
    if (isset($_SESSION['account'])) {
        #Kiểm tra time out
        $timeout = (time() - $_SESSION['account']['timeout'] < SESSION_TIMEOUT) ? false : true;
        if ($timeout){
            unset($_SESSION['account']);
            return -1;
        }
        elseif ($_SESSION['account']['isadmin'] == 1)
            return 1;
        else
            return 0;  //0
    }
    return -1;
}

function getUsername() {
    if(isset($_SESSION['account']))
        return $_SESSION['account']['username'];
    return false;
}

function isRemember() {
    if (isset($_COOKIE['account']))
        return true;
    return false;
}

function getSubstring($string, $length) {
    $len = strlen($string);
    if ($len <= $length)
        return $string;
    $tmpStr = substr($string, 0, $length);
    return substr($tmpStr, 0, strrpos($tmpStr, " ")) . "...";
}

?>
