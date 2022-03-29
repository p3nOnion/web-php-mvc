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
    <style>
        body {
            background: #231e39;
            color: #b3b8cd;
        }
    </style>
</head>
<body>
<div class="container">
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
            if (isset($_POST['title']) && isset($_POST['content']) && isset($_POST['tag'])) {
                if ($_POST['title'] != "" || $_POST['content'] != "" || $_POST['tag'] != "") {
                    $postController->createPost($_SESSION['username'], $_SESSION['password'], $_POST['title'], $_POST['content'], $_POST['tag'], $_SESSION['id']);
                    unset($_POST);
                } else {
                    $accountController->index();
                }
            }
            ?>

            <nav class="navbar navbar-dark bg-dark">
                <div class="container-fluid">
                    <a href="/" class="navbar-brand">Home</a>

                    <form action="" class="d-flex">
                        <input class="form-control me-6" type="search" id="search"
                               onkeyup="showHint('content='+this.value) ">
                    </form>
                    <div>
                        <?php
                        if ($_SESSION['permission'] == 1) {
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
            <div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class=" form-label">Create Post</label>
                    <input type="submit" value="Create" name="createPost" class="text-light bg-dark form-control"
                           id="createPost"
                           onclick="showPost()">
                </div>
                <form method="POST" hidden id="create">

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class=" form-label">Title</label>
                        <input type="text" value="" placeholder="title" name="title"
                               class=" text-light bg-dark form-control" id="title">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Content</label>
                        <textarea class=" bg-dark text-light  form-control" value="" id="content" name="content"
                                  rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Tag</label>
                        <input type="text" value="" placeholder="tag" name="tag"
                               class="text-light  bg-dark form-control" id="tag">
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
                               onkeyup="showHint('content='+this.value) ">
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
                    <input class="form-control me-12" type="search" id="search" onkeyup="showHint('content='+this.value)">
                </form>
                <a class="btn btn-outline-success" href="login.php">Login</a>
            </div>

        </nav><?php
    }

    ?>
    <input type="submit" value="OwnPost" onclick="showHint('author=owner')">
    <input type="submit" value="ALL" onclick="showHint('content=')">
    <h2>Posts:</h2>
    <span id="txtHint"></span>
</div>
<script>

    function showPost() {
        var create = document.getElementById("create").hidden;
        if (create) {
            document.getElementById("create").hidden = false;
            document.getElementById('createPost').value = "Hide";
        } else {
            document.getElementById("create").hidden = true;
            document.getElementById('createPost').value = "Create";
        }
    }

    function getAuthor(id, author) {
        console.log(id);
        var text = '';
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                author = xmlhttp.responseText;
            }
        }
        $(this).innerText = text;
        xmlhttp.open("GET", "api.php?id=" + id, true);
        xmlhttp.send();
    }

    function showHint(str) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                // var output =JSON.parse(xmlhttp.responseText);
                var text = "";
                value = xmlhttp.responseText;
                var data = JSON.parse(value);
                for (i = 0; i < data.length; i++) {
                    text += '<hr><h2><a href="post.php?id=' + data[i][0] + '">' + data[i][1] + '<a></h2><h3>' + data[i][1] + '</h3><p>Author:' + data[i][3] + ' </p><p>Time:' + data[i][4] + '  </p><p>Tag:' + data[i][2] + '  </p>';
                }
                document.getElementById("txtHint").innerHTML = text;
            }
        }
        xmlhttp.open("GET", "http://localhost/post.php?" + str, true);
        xmlhttp.send();
    }

    window.onload = showHint('content=');
</script>

</body>
</html>