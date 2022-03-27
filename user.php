<?php

require_once ("controllers/AccountController.php");
$accountController = new AccountController();
if(isset($_SESSION['username']) && isset($_SESSION['password']))
    $accountController->aboutUser($_SESSION['username'], $_SESSION['password']);