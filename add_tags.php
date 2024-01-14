<?php
require_once './controllers/Wiki_controller.php';
require_once './controllers/Tags_controller.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tagsString = $_POST['tags'];

    $tagsArray = explode(',', $tagsString);

    $tagsArray = array_map('trim', $tagsArray);
    $tagsArray = array_map('htmlspecialchars', $tagsArray);

    $title = $_POST['title'];
    $description = $_POST['description'];
    $tagCategory = $_POST['tagCategory'];

    foreach ($tagsArray as $tagName) {
        $tagCategory = $_POST['tagCategory'];

        $tagsController = new TagsController();
        $tagsController->addTag($tagName, $tagCategory);
    }

    echo json_encode(['success' => true]);
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>
