<?php
if (isset($_SESSION['username']) && isset($_SESSION['password']))
    if ($accountController->accountModel->accesssAccount($_SESSION['username'], $_SESSION['password'])) {
        if (isset($_POST['createPost'])) {
            if (isset($_POST['title']) && isset($_POST['content']) &&isset($_POST['tag']))
                $postController->createPost($_SESSION['username'], $_SESSION['password'], $_POST['title'], $_POST['content'], $_POST['tag'], $_SESSION['id']);
            else{
                echo 'ss';
            }
        }
        ?>
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
        <?php
        require ("templates/html/base.php");
        ?>
        <a href="logout">logout</a>
        <a href="user.php">about</a>
        <form method="POST">
            <input type="text" placeholder="title" name="title">
            <input type="text" placeholder="content" name="content">
            <input type="text" placeholder="tag" name="tag">
            <input type="submit" value="submit" name="createPost">
        </form>
        </body>
        </html>
        <?php
    } else {
        $accountController->logout();
        ?><a href="login.php">login</a><?php
    } else if ($url == '/') {
    ?><a href="login.php">login</a><?php
}?>
