<?php
$url = $_SERVER["REQUEST_URI"];
$parts = parse_url($url);
require("controllers/AccountController.php");
$controller = new AccountController();
if (isset($parts['query'])) {
    parse_str($parts['query'], $query);
    if(isset($query['id'])) $controller->getAuthorByID($query['id']);
}