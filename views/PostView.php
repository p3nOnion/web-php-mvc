<?php

class PostView
{
    public function viewPostByAuthor($posts){
        require('templates/html/posts.php');
    }
    public function viewPostByContent($posts){
        require('templates/html/posts.php');
    }
    public function viewPostByID($post){
        require('templates/html/posts.php');
    }
    public function viewAllPost($posts){
        require('templates/html/posts.php');
    }
}