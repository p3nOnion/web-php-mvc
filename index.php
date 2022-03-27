<!doctype html>
<html lang="en">
<head>
    <?php
    require("templates/html/bootstrap.php");
    ?>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
</head>
<body><div class="container">
<?php
require_once('controllers/AccountController.php');
require_once('controllers/PostController.php');
$accountController = new AccountController();
$postController = new PostController();
$url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

switch ($url) {
    case "/logout":
        $accountController->logout();
        break;
}
if (isset($_SESSION['username']) && isset($_SESSION['password']))
    if ($accountController->accountModel->accesssAccount($_SESSION['username'], $_SESSION['password'])) {
        if (isset($_POST['createPost'])) {
            if ($_POST['title'] != "" && $_POST['content'] != "" && $_POST['tag'] != "")
                $postController->createPost($_SESSION['username'], $_SESSION['password'], $_POST['title'], $_POST['content'], $_POST['tag'], $_SESSION['id']);
            else {
                $accountController->index();
            }
        }
        ?>

        <nav class="navbar navbar-light bg-light">
            <div class="container-fluid">
                <a href="/" class="navbar-brand">Home</a>

                <form class="d-flex">
                    <input class="form-control me-12" type="search" id="search"
                           oninput="showHint(this.value)">
                </form>
                <div>
                    <?php
                    if($_SESSION['permission']==1){
                        ?>
                        <a class="btn btn-outline-success" href="accounts.php">All Accounts</a>
                        <?php
                    }
                    ?>
                    <a class="btn btn-outline-success" href="logout">Logout</a>
                    <a class="btn btn-outline-success" href="user.php">About</a>
                </div>

            </div>
        </nav>
        <div >
        <form method="POST">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Title</label>
                <input type="text" placeholder="title" name="title" class="form-control" id="exampleFormControlInput1">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Content</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" name="content" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Tag</label>
                <input type="text" placeholder="tag" name="tag" class="form-control" id="exampleFormControlInput1">
            </div>
            <div class="mb-3">
                <input class="btn btn-light form-control" type="submit" value="Post" name="createPost">
            </div>

        </form>
        </div>
        <?php
    } else {
        $accountController->logout();
        ?>
        <nav class="navbar navbar-light bg-light">
            <div class="container-fluid">
                <a href="/" class="navbar-brand">Home</a>
                <a href="login.php">Login</a>
                <form action="" class="d-flex">
                    <input class="form-control me-6" type="search" id="search"
                           onkeyup="showHint(this.value) ">
                </form>
            </div>
        </nav><?php
    }
else if ($url == '/') {
    ?>
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <a href="/" class="navbar-brand">Home</a>
            <form action="" class="d-flex">
                <input class="form-control me-12" type="search" id="search" onkeyup="showHint(this.value)">
            </form>
            <a class="btn btn-outline-success" href="login.php">Login</a>
        </div>

    </nav><?php
}

?>

<p>Suggestions: <span id="txtHint"></span></p>
</div>
<script>
    function showHint(str) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                // var output =JSON.parse(xmlhttp.responseText);
                document.getElementById("txtHint").innerHTML = JSON.parse(xmlhttp.responseText);
            }
        }
        xmlhttp.open("GET", "http://localhost/post.php?content=" + str, true);
        xmlhttp.send();
    }
    window.onload= showHint('all');
</script>

</body>
</html>