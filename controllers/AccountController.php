<?php

class AccountController
{
    var $permission;
    var $username;
    var $password;
    var $accountModel;
    var $views;

    public function __construct()
    {
        if (!isset($_SESSION)) session_start();
        require_once('models/AccountModel.php');
        $this->accountModel = new AccountModel();
        require_once('views/AccountView.php');
        $this->views = new AccountView();
    }

    public function index()
    {
        $this->views->index();
    }

    public function access($username, $password)
    {
        $result = $this->accountModel->accesssAccount($username, $password);
        print $result;
        if ($result) {
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            $this->username = $username;
            $this->password = $password;
            $user = $this->accountModel->getAccount($_SESSION['username'], $_SESSION['password']);
            $_SESSION['permission'] = $user['permission'];
            $_SESSION['id'] = $user['id'];
            echo "<script type='text/javascript'>alert('Login');</script>";
            $this->views->index();//$this->accountModel->getAccount($username, $password));
        } else {
            echo "<script type='text/javascript'>alert('Username or password incorrect!');</script>";
            $this->views->login();
        }
    }

    public function login()
    {
        $this->views->login();
    }

    public function logout()
    {
        session_reset();
        session_destroy();
        $this->views->index();
    }

    public function register($username, $password, $firstname, $lastname, $email)
    {
        if ($this->accountModel->statusAccount($username, $email)) {
            $this->accountModel->register($username, $password, $firstname, $lastname, $email);
            echo "<script type='text/javascript'>alert('Create an successful account!');</script>";
        } else {
            echo "<script type='text/javascript'>alert('Create an unsuccessful account!');</script>";
        }
    }

    public function updateAboutUser($username, $firstname, $lastname, $email, $birthday)
    {
        if ($this->accountModel->updateAboutUser($username, $firstname, $lastname, $email, $birthday)) {
            echo "<script type='text/javascript'>alert('Update an successful account!');</script>";
        } else {
            echo "<script type='text/javascript'>alert('Update an unsuccessful account!');</script>";
        }
    }

    public function updatePasswordUser($username, $firstname, $lastname, $email, $birthday)
    {
        if ($this->accountModel->updateAboutUser($username, $firstname, $lastname, $email, $birthday)) {
            echo "<script type='text/javascript'>alert('Update an successful passowrd!');</script>";
        } else {
            echo "<script type='text/javascript'>alert('Update an unsuccessful password!');</script>";
        }
    }

    public function deleteUser($username)
    {
        if ($this->permission == 1) {
            echo "<script type='text/javascript'>alert('You are not authorized to make this request');</script>";
        } else {
            if ($this->accountModel->deleteUser($username)) {
                echo "<script type='text/javascript'>alert('Account deleted successfully');</script>";
            } else {
                echo "<script type='text/javascript'>alert('Account deletion failed');</script>";

            }
        }
    }


    public function aboutUser($username, $password)
    {
        $user = $this->accountModel->getAccount($username, $password);
        $this->views->aboutUser($user);
    }

    public function getUser($username, $password)
    {
        $this->accountModel->getAccount($username, $password);
    }

    public function changeAbout()
    {
        echo 'edit account';
    }

    public function getUserById($username, $password, $permission, $id)
    {

        if ($permission == 1) {
            $user = $this->accountModel->getUserByID($id);
            $this->views->showAccount($user);
        } else {
            $user = $this->accountModel->getAccount($username, $password);
            if ($user == $id) {
                $this->views->showAccount($user);
            } else {
                echo "you don't have permission";
            }
        }

    }

    public function getAuthorByID($id)
    {
        $this->views->getAuthorByID($this->accountModel->getUserByID($id)['username']);
    }

    public function showAllAccout($permission)
    {
        if ($this->accountModel->accesssAccount($_SESSION['username'], $_SESSION['password'])&&$permission != 1) {
            echo "<script type='text/javascript'>alert('you don\'t have permission');</script>";
            $this->views->index();
        }
        if ($permission == 1) {
            $accounts = $this->accountModel->getAllAccout();
            require_once('views/AccountView.php');
            $this->views->showAllAccounts($accounts);
        }
    }

    public function statusAccount($username, $email)
    {
        $posts = $this->accountModel->showAllAccout();
        require_once('views/AccountView.php');
        $view = new AccountView();
        $view->showAdminAccount($posts);
    }
}