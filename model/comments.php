<?php 
require_once 'database.php';

class Comments{
    private $connect;

    function __construct(){
        $this->connect = database_connect();
    }

    function select_comment() {
        $sql = "SELECT * FROM `comments` ORDER BY `commentid` DESC";
        $query = $this->connect->query($sql);
        $result = array();
        while ($row = $query->fetch_assoc()){
            array_push($result, $row);
        }
        return $result;
    }

    function get_comment($bookId) {
        $bookId = intval($bookId);
        $sql = "SELECT * FROM `comments` WHERE `bookid` = '{$bookId}' ORDER BY `commentid` DESC";
        $query = $this->connect->query($sql);
        $result = array();
        while ($row = $query->fetch_assoc()){
            array_push($result, $row);
        }
        return $result;
    }

    function insert_comment($bookId, $username, $comment) {
        $sql = "INSERT INTO `comments` (`username`,`bookid`,`comment`) VALUES ('{$username}','{$bookId}','{$comment}')";
        $query = $this->connect->query($sql);
        if ($query){
            return 1;
        }
        return 0;
    }

    function delete_comment($commentId, $bookId, $username = null) {
        $commentId = intval($commentId);
        $bookId = intval($bookId);
        if (!is_null($username)){
            $sql = "DELETE FROM `comments` WHERE `commentid` = {$commentId} AND `bookid` = {$bookId} AND  `username` = '{$username}'";
        }
        else{
            $sql = "DELETE FROM `comments` WHERE `commentid` = {$commentId} AND `bookid` = {$bookId}";
        }
        echo $sql;
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