<?php
require_once 'database.php';

class Books {

    private $connect;
    
    //Tao kết nối 
    function __construct(){
        $this->connect = database_connect();
    }

    function select_book($key=null) {
        if (is_null($key)){
            $sql = "SELECT * FROM `books` ORDER BY `bookid`";
        }
        else{
            $sql = "SELECT * FROM `books` WHERE `title` LIKE '%{$key}%' OR `description` LIKE '%{$key}%' ORDER BY `bookid`";
        }
        $query = $this->connect->query($sql);
        $result = array();
        while($row = $query->fetch_assoc()){
            array_push($result, $row);
        }
        return $result;
    }

    function get_book($bookId){
        $sql = "SELECT * FROM `books` WHERE `bookid` = '{$bookId}'";
        $query = $this->connect->query($sql);
        $result = array();
        if ($query){
            while($row = $query->fetch_assoc()){
                array_push($result, $row);
            }
            return $result;
        }
        return False;
    }

    function delete_book($bookId){
        $sql = "DELETE FROM `books` WHERE `bookid` = '{$bookId}'";
        $query = $this->connect->query($sql);
        if ($query){
            return 1;
        }
        return 0;
    }

    function insert_book($data){
        $sql = "INSERT INTO `books` (`title`,`price`,`description`,`image`) VALUE('{$data['title']}','{$data['price']}','{$data['description']}','{$data['image']}')";
        $query = $this->connect->query($sql);
        if ($query){
            return 1;
        }
        return 0;
    }

    
    function update_book($data = array(), $bookId) {
        $bookId = intval($bookId);
        $sql = "UPDATE `books` set ";
        $tmp = array();
        foreach ($data as $key => $value) {
            if (!is_null($value)) {
                array_push($tmp, "`{$key}`='{$value}'");
            }
        }
        $sql.=implode(", ", $tmp);
        $sql .= " WHERE `bookid` = '{$bookId}'";
        $query = $this->connect->query($sql);
        #insert thành công
        if ($query){
            return True;
        }
        return False;
    }


    function connect_close(){
        mysqli_close($this->connect);
    }

}

?>