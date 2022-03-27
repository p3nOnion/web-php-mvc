<?php

class AccountView
{
    public function showAdminAccount($posts){
        require('templates/showAboutAccount.php');
    }
    public function login(){
//        $_GET['url'] = strtok($_GET['url'], '?');
//        header("Location: /login.php");
        require_once("login.php");
    }
    public function index(){
        header("Location: /");
    }
    public function aboutUser($user){
        require_once('templates/html/aboutUser.php');
    }
    public function showAllAccounts($accounts){
        require_once('templates/html/accounts.php');
    }
    public function getAuthorByID($value){
        require_once('api/output.php');
    }
    public function showAccount($user){
        print_r($user);
    }

}