<?php

class AccountModel
{
    var $conn = '';
    var $result;


    public function __construct()
    {
        try {
            $this->conn = mysqli_connect('localhost', 'root', '', 'ncsc');
            if (mysqli_connect_errno()) {
                echo 'Connect to database failed with error: ' . mysqli_connect_error();
                exit();
            } else {
                $query = "select * from accounts";
                $this->result = $this->conn->query($query);
            }
        } catch (Exception $e) {
            echo "<script type='text/javascript'>alert('Don\'t connect data base');</script>";
            echo $e;
            exit();
        }
    }

    //dang ki tai khoan
    public function register($username, $password, $firstname, $lastname, $email)
    {
        $query = "INSERT INTO accounts (username, password, firstname, lastname,email ) VALUES ('%s', '%s', '%s', '%s', '%s');";
        $query = sprintf($query,
            addslashes($username),
            addslashes(md5($password)),
            addslashes($firstname),
            addslashes($lastname),
            addslashes($email)
        );
        $this->conn->query($query);
    }
    public function updateAboutUser($username,$firstname, $lastname, $email, $birthday){
        $query = "UPDATE accounts SET firstname ='%s', lastname='%s',email='%s', birthday='%s' WHERE username = '%s';";
        $query = sprintf($query,
            addslashes($firstname),
            addslashes($lastname),
            addslashes($email),
            addslashes($username)
        );
        try {
            $this->conn->query($query);
            return true;
        }catch (Exception $e){
            return false;
        }
    }
    public function deleteUser($username){
        $query = "DELETE FROM accounts WHERE username = '%s';";
        $query = sprintf($query,
            addslashes($username)
        );
        try {
            $this->conn->query($query);
            return true;
        }catch (Exception $e){
            return false;
        }
    }
    public function updatePasswordUser($username, $password){
        $query = "UPDATE accounts SET password = '%s' WHERE username = '%s';";
        $query = sprintf($query,
            addslashes(md5($password)),
            addslashes($username)
        );
        try {
            $this->conn->query($query);
            return true;
        }catch (Exception $e){
            return false;
        }
    }

    public function registeradmin($username, $password, $firstname, $lastname, $email)
    {
        $query = "INSERT INTO accounts (username, password, firstname, lastname,email, permission ) VALUES ('%s', '%s', '%s', '%s', '%s','%d')";
        $query = sprintf($query,
            addslashes($username),
            addslashes(md5($password)),
            addslashes($firstname),
            addslashes($lastname),
            addslashes($email),
            1
        );
        $this->conn->query($query);
    }

    public function getAllAccout()
    {
            return $this->result->fetch_all();
    }
    public function getUser($username){
        $query = "SELECT * FROM accounts WHERE username = '%s' ";
        $query = sprintf($query,
            addslashes($username),
        );
        return $this->conn->query($query)->fetch_assoc();
    }

    public function getAccount($username, $password)
    {
        $query = "SELECT * FROM accounts WHERE username = '%s' AND password = '%s'";
        $query = sprintf($query,
            addslashes($username),
            addslashes(md5($password))
        );
        return $this->conn->query($query)->fetch_assoc();
    }
    public function getUserByID($id){
        $query = "SELECT * FROM accounts WHERE id = '%s' ";
        $query = sprintf($query,
            addslashes($id),
        );
        return $this->conn->query($query)->fetch_assoc();
    }

    //kiem tra tai khoan ton tai hay khong
    public function statusAccount($username, $email)
    {
        $query = "SELECT * FROM accounts WHERE username = '%s' or email = '%s'";
        $query = sprintf($query,
            addslashes($username),
            addslashes($email)
        );
        if (mysqli_query($this->conn, $query)->num_rows > 0) return false;
        return true;
    }

    //kiem tra tai khoan va mat khau de login
    public function accesssAccount($username, $password)
    {
        if ($this->conn == '') {
            return false;
        }
        $query = "SELECT * FROM accounts WHERE username = '%s' AND password = '%s'";
        $query = sprintf($query,
            addslashes($username),
            addslashes(md5($password))
        );
        try {
            $result = mysqli_query($this->conn, $query);
            if ($result->num_rows > 0) {
                return true;
            }
            return false;
        } catch (mysqli_sql_exception $e) {
            return false;
        }
    }
}