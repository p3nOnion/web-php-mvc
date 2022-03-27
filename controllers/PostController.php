<?php

class PostController
{
    var $postModel;
    var $views;
    var $accountController;

    public function __construct()
    {
        if (!isset($_SESSION)) session_start();
        require_once('models/PostModel.php');
        $this->postModel = new PostModel();
        require_once('views/PostView.php');
        $this->views = new PostView();
        require_once('controllers/AccountController.php');
        $this->accountController = new AccountController();
    }
    public function createPost($username, $password, $title, $content, $tag,$author){
        if($this->accountController->accountModel->accesssAccount($username,$password))
        $this->postModel->createPost($title, $content, $tag, $author);
    }
    public function getAllpost(){
        $this->views->viewAllPost($this->postModel->getAllpost());
    }
    public function getPostByAuthor($author){
        $this->views->viewPostByAuthor($this->postModel->getPostByAuthor($author));
    }
    public function getPostByContent($content){
        $this->views->viewPostByContent($this->postModel->getPostByContent($content));
    }
    public function getPostByID($id){
        $this->views->viewPostByID($this->postModel->getPostByID($id));
    }
    public function changePostByID($id, $title, $content, $tag){
        if($_SESSION['permission']==1){
            $this->postModel->deletePostByID($id);
        }else{
            if($this->accountController->access($_SESSION['username'], $_SESSION['password'])){
        $this->postModel->changePostByID($id, $title, $content, $tag);
            }else{
                echo "you don't have permission";
            }
        }
    }
    public function deletePostByID($id, $username, $password, $permission){
        if($permission==1){
            $this->postModel->deletePostByID($id);
        }else{
            if($this->accountController->access($username, $password)){
                $this->postModel->deletePostByID($id);
            }else{
                echo "you don't have permission";
            }
        }

    }
}