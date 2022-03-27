<?php
require_once ('models/AccountModel.php');
$model = new AccountModel();
print "Create user admin";
print "input username";
$username = trim(fgets(STDIN));
print "input password";
$password = trim(fgets(STDIN));
print "input firstname";
$firstname = trim(fgets(STDIN));
print "input lastname";
$lastname = trim(fgets(STDIN));
print "input email";
$email = trim(fgets(STDIN));
//$model->registeradmin();
echo $username.$password.$firstname.$lastname.$email;
