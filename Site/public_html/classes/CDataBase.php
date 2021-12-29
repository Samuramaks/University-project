<?php

//SQL JOIN

class CDataBase {
    private $server = '127.0.0.1';
    private $user = 'root';
    private $pass = 'root';
    private $db = 'mysite';
    private $mysqli = null; //Готовое подключение

    function __construct() {
        $connect = new mysqli($this->server, $this->user, $this->pass, $this->db);

        if (!empty($connect->connect_errno)) {
            die('Error: Data base connect error (' . $connect->connect_errno . ') ' . $connect->connect_error);
        }

        $this->mysqli = $connect;
    }

    public function selectAll($tableName, $whereFieldName = '', $whereVal = '') {
        $sqlQuery = 'SELECT * FROM ' . $tableName;

        if (!empty($whereFieldName) && !empty($whereVal)) {
            $sqlQuery .= ' WHERE ' . $whereFieldName . ' = "' . $whereVal . '"';
        }

        $obj = $this->mysqli->query($sqlQuery);

        if (!empty($this->mysqli->error_list)) {
            die('Error: Data base error (' . $this->mysqli->errno . ') ' . $this->mysqli->error);
        }

        $result = array();
        while ($row = $obj->fetch_assoc()) {
            $result[] = $row;
        };

        return $result;
    }

    public function getUserID($login){
        $sel = "SELECT id FROM users WHERE login = '$login'";
        $result = $this->mysqli->query($sel);
        $id = $result->fetch_assoc();
        return $id['id'];
    }

    public function addUser($login, $pas){
        $sel = "SELECT * FROM users WHERE login = '$login'";
        $res = $this->mysqli->query($sel);
        $num = mysqli_num_rows($res);

        if($num == 0) {
            //добавляем в бд
            $sql = "INSERT INTO `users` (`login`, `pas`) VALUES('$login', '$pas')";
            $result = $this->mysqli->query($sql);
            if($result) { return true; }
            else  { echo "Error"; }
        }
        else { return false; }
    }

    public function authorize($login, $pas){
        $sql = "SELECT * FROM `users` WHERE `login` = '$login' AND `pas` = '$pas'";
        $result = $this->mysqli->query($sql);
        $user = $result->fetch_assoc();

        if (count($user) == 0){
            return false;
        }

        return $user;
    }


    public function questions($login, $name, $quest,$school){
        //добавляем в бд
        $sql = "INSERT INTO `questions` (`login`, `name`, `quest`,`school`) VALUES ('$login', '$name', '$quest','$school')";
        $result =$this->mysqli->query($sql);
        if($result) { return true; }
        else  { echo "Error"; }
    }

    public function Rows()
    {
        $res = $this->mysqli->query("SELECT * FROM questions");
        $rows = $res->fetch_all(MYSQLI_ASSOC);
        return $rows;
    }
    public function Row()
    {
        $res = $this->mysqli->query("SELECT * FROM users");
        $rows = $res->fetch_all(MYSQLI_ASSOC);
        return $rows;
    }
    public function Delete($del){
        $this->mysqli->query("DELETE FROM users WHERE id = $del");
    }

    public function close(){
        $this->mysqli->close();
    }
}

