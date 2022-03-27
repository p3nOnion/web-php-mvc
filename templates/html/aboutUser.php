<?php
/** @var TYPE_NAME $user */
print("username: ".$user['username']."<br>");
print("email: ".$user['email']."<br>");
print("firstname: ".$user['firstname']."<br>");
print("lastname: ".$user['lastname']."<br>");
if($user['permission']==1){
    print("permission: admin user<br>");
}else{
    print("permission: nomal user<br>");
}