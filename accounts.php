<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<?php /** @var TYPE_NAME $accounts */
require_once ("controllers/AccountController.php");
$accountController = new AccountController();
$url=$_SERVER["REQUEST_URI"];
$parts = parse_url($url);
if(isset($parts['query'])){
    parse_str($parts['query'], $query);
}

if(isset($_SESSION['username']) && isset($_SESSION['password'])&&isset($_SESSION['permission'])){
    if(isset($query['id'])){
        $accountController->getUserById($_SESSION['username'], $_SESSION['password'],$_SESSION['permission'],$query['id']);
    }else{
        $accountController->showAllAccout($_SESSION['permission']);
    }
    if(isset($query['edit'])){
        $accountController->changeAbout();
    }
    if(isset($query['delete'])){
        $accountController->deleteUser($query['delete']);

        $accountController->showAllAccout($_SESSION['permission']);
    }
}
?>
<script>
    jQuery(document).ready(function($) {
        window.history.pushState({}, document.title, "/accounts.php" );
    });
</script>
</body>
</html>