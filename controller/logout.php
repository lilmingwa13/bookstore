<?php
if (privilege() != -1){
    setcookie('account', '', time() - 3600);
    session_destroy();
}
header("location:index.php");
?>
