<?php
require_once 'database.php';

class Users{
    private $connect;

    //tao ket noi
    function __construct(){
        $this->connect = database_connect();
    }

    function select_user(){
        $sql = "SELECT * FROM `users` ORDER BY `time` DESC";
        $query = $this->connect->query($sql);
        $result = array();
        while($row = $query->fetch_assoc()){
            array_push($result, $row);
        }
        return $result;
    }

    
    function check_login($username, $password) {
        if (!$this->check_exists($username))
            return -1;
        $sql = "SELECT * FROM users WHERE username = '{$username}' AND password = '{$password}'";
        #$sql = "SELECT * FROM users WHERE username = ? AND password = ?";
        $query = $this->connect->query($sql);
        #$query = $this->connect->prepare($sql);
        $num_rows = mysqli_num_rows($query);
        if ($num_rows == 1) {
            $user = $query->fetch_assoc();
            if (privilege() == -1) {
                $_SESSION['account'] = array(
                    "username" => $user['username'],
                    "isadmin" => $user['isadmin'],
                    "timeout"=>time()
                );
            }
            return 1;
        }
        return 0;
    }

    // function check_login($username, $password) {
    //     if (!$this->check_exists($username)) {
    //         return -1;
    //     }
    //     $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
    //     $stmt = $this->connect->prepare($sql);
    //     if ($stmt === false) {
    //         die("Prepare failed: " . $this->connect->error);
    //     }
    //     $stmt->bind_param('ss', $username, $password);
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    //     $num_rows = $result->num_rows;
    //     if ($num_rows == 1) {
    //         $user = $result->fetch_assoc();
    //         if (privilege() == -1) {
    //             $_SESSION['account'] = array(
    //                 "username" => $user['username'],
    //                 "isadmin" => $user['isadmin'],
    //                 "timeout" => time()
    //             );
    //         }
    //         $stmt->close();
    //         return 1;
    //     }
    
    //     $stmt->close();
    //     return 0;
    // }
    

    function get_user($username) {
        $sql = "SELECT * FROM users WHERE username = '{$username}'";
        $query = $this->connect->query($sql);
        if ($query){
            return $query->fetch_assoc();
        }
        return False;
    }

    
    private function check_exists($username) {
        $sql = "SELECT * FROM users WHERE username = '{$username}'";
        $query = $this->connect->query($sql);
        $num_rows = mysqli_num_rows($query);
        if ($num_rows == 0){
            return false;
        }
        return true;
    }

    function insert_user($username, $password, $isadmin = null) {
        if ($this->check_exists($username))
            return -1;
        if (is_null($isadmin))
            $sql = "INSERT INTO users (`username`,`password`) VALUES('{$username}','{$password}')";
        else {
            $isadmin = intval($isadmin);
            $sql = "INSERT INTO users (`username`,`password`,`isadmin`) VALUES('{$username}','{$password}',{$isadmin})";
        }
        $query = $this->connect->query($sql);
        #insert thành công
        if ($query){
            return 1;
        }
        return 0;
    }

    function remove_user($username) {
        $sql = "DELETE FROM `users` WHERE `username` = '{$username}'";
        $query = $this->connect->query($sql);
        if ($query){
            return 1;
        }
        return 0;
    }

    function update_user($data = array(), $username) {
        $sql = "UPDATE `users` set ";
        $tmp = array();
        foreach ($data as $key => $value) {
            if (!is_null($value)) {
                array_push($tmp, "`{$key}`='{$value}'");
            }
        }
        $sql.=implode(", ", $tmp);
        $sql .= " WHERE `username` = '{$username}'";
        $query = $this->connect->query($sql);
        if ($query){
            return 1;
        }
        return 0;
    }

    function connect_close(){
        mysqli_close($this->connect);
    }

}


?>