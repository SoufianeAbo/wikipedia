<?php
require_once './controllers/Tags_controller.php';

if (isset($_POST['categoryId'])) {
    $categoryId = $_POST['categoryId'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "wiki";

    $tagController = new TagsController($servername, $username, $password, $dbname);

    $tags = $tagController->getTagsByCategory($categoryId);

    header('Content-Type: application/json');
    echo json_encode($tags);
} else {
    header('HTTP/1.1 400 Bad Request');
    echo 'Error: categoryId not provided in the request.';
}
?>