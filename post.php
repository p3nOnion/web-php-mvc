<?php
$url = $_SERVER["REQUEST_URI"];
$parts = parse_url($url);
require_once("controllers/PostController.php");
$postController = new PostController();
if (isset($parts['query'])) {
    parse_str($parts['query'], $query);
    if (isset($query['id'])) $postController->getPostByID($query['id']);
    elseif (isset($query['author'])) {
        $postController->getPostByAuthor($query['author']);
    } elseif (isset($query['content'])) {
        if($query['content']=="all" or $query['content']==""){
            $postController->getAllpost();
        }else{
            $postController->getPostByContent($query['content']);
        }
    }
} else {
    $postController->getAllpost();
}
?>
