<?php
require_once('controllers/AccountController.php');
$accountController = new AccountController();
if (isset($_SESSION['username'])&&isset($_SESSION['password'])){
    $accountController->index();
}
if (isset($_GET['username']) && isset($_GET['password'])) {
    $accountController->access($_GET['username'], $_GET['password']);
}
if(isset($_POST['register'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $accountController->register($username, $password, $firstname, $lastname, $email);
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="templates/css/login.css">
    <title>Login</title>
</head>
<body>
<div class="login-wrap">
    <div class="login-html">
        <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
        <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>
        <div class="login-form">
            <div class="sign-in-htm">
                <form method="get" action="login.php">
                    <div class="group">
                        <label for="user" class="label">Username</label>
                        <input id="user" type="text" name="username" required class="input">
                    </div>
                    <div class="group">
                        <label for="pass" class="label">Password</label>
                        <input id="pass" type="password" name="password" required class="input" data-type="password">
                    </div>
                    <div class="group">
                        <input id="check" type="checkbox" class="check" checked>
                        <label for="check"><span class="icon"></span> Keep me Signed in</label>
                    </div>
                    <div class="group">
                        <input type="submit" class="button" name="login" value="Sign In">
                    </div>
                    <div class="hr"></div>
                    <div class="foot-lnk">
                        <a href="#forgot">Forgot Password?</a>
                    </div>
                </form>
            </div>
            <div class="sign-up-htm">
                <form method="post" action="login.php">
                    <div class="group">
                        <label for="firstname" class="label">Firstname</label>
                        <input id="firstname" name="firstname" type="text" required class="input">
                    </div>
                    <div class="group">
                        <label for="lastname" class="label">Lastname</label>
                        <input id="lastname" name="lastname" type="text" required class="input">
                    </div>
                    <div class="group">
                        <label for="user" class="label">Username</label>
                        <input id="user" name="username" type="text" required class="input">
                    </div>
                    <div class="group">
                        <label for="pass" class="label">Password</label>
                        <input id="passwd" name="password" type="password" class="input" required data-type="password">
                    </div>
                    <div class="group">
                        <label for="pass" class="label">Repeat Password</label>
                        <input id="repasswd" name="re_password" type="password" class="input" required data-type="password">
                        <span id='message'></span>
                    </div>
                    <div class="group">
                        <label for="pass" class="label">Email Address</label>
                        <input id="pass" name="email" type="email" required class="input">
                    </div>
                    <div class="group">
                        <input type="submit" class="button" name="register" value="Sign Up" onclick="return Validate()">
                    </div>
                    <div class="hr"></div>
                    <div class="foot-lnk">
                        <a for="tab-1">Already Member?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="templates/js/login.js"></script>
</body>
</html>