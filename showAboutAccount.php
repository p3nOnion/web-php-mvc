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
    foreach ($accounts as $account):
        if($account[7]!=1){
            print_r($account);
            echo "<br>";
        }
    endforeach;?>
</body>
</html>