<?php

class PostModel
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
                $query = "select * from posts order by `time` desc";
                $this->result = $this->conn->query($query);
            }
        } catch (Exception $e) {
            echo "<script type='text/javascript'>alert('Don\'t connect data base');</script>";
            echo $e;
            exit();
        }
    }
    public function createPost($title, $content, $tag, $author){
        $query = "INSERT INTO posts (title, content, authors, `time`,tag ) VALUES ('%s', '%s', '%s', '%s', '%s')";
        $query = sprintf($query,
            addslashes($title),
            addslashes($content),
            addslashes($author),
            addslashes(date('Y-m-d h:m:s')),
            addslashes($tag),
        );
        try {
            $this->conn->query($query);
            echo "<script type='text/javascript'>alert('Create post successfuly!');</script>";
        }catch (Exception $e){
            echo $e;
            echo "<script type='text/javascript'>alert('You can\'t create post!');</script>";
        }
    }
    public function getAllpost(){
        return $this->result->fetch_all();
    }
    public function getPostByAuthor($author){
        $query = "SELECT * FROM posts WHERE authors = '%s' ";
        $query = sprintf($query,
            addslashes($author),
        );
        return $this->conn->query($query)->fetch_assoc();
    }
    public function getPostByContent($content){
        $query = "SELECT * FROM posts WHERE content like '%s%s%s' OR title like '%s%s%s'";
        $query = sprintf($query,
            addslashes('%'),
            addslashes($content),
            addslashes('%'),
            addslashes('%'),
            addslashes($content),
            addslashes('%'),
        );
        return $this->conn->query($query)->fetch_all();
    }
    public function getPostByID($id){
        $query = "SELECT * FROM posts WHERE id = '%s' ";
        $query = sprintf($query,
            addslashes($id),
        );
        return $this->conn->query($query)->fetch_assoc();
    }
    public function changePostByID($id, $title, $content, $tag){
        $query = "UPDATE posts SET title ='%s', content='%s',tag='%s', `time`='%s' WHERE id = '%s';";
        $query = sprintf($query,
            addslashes($title),
            addslashes($content),
            addslashes(date('YYYY-MM-DD hh:mm:ss')),
            addslashes($tag),
            addslashes($id),
        );
        try {
            $this->conn->query($query);
            return true;
        }catch (Exception $e){
            return false;
        }
    }
    public function deletePostByID($id){
        $query = "DELETE FROM posts WHERE id = '%s';";
        $query = sprintf($query,
            addslashes($id)
        );
        try {
            $this->conn->query($query);
            return true;
        }catch (Exception $e){
            return false;
        }
    }
}