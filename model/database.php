<?php
function database_connect(){
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DATA);
    if($conn -> connect_errno){
        echo "Khong the ket noi den MySQL: " . $conn -> connect_error;
        exit();
    }
    return $conn;
}

function database_close($conn){
    mysqli_close($conn);
}
?>