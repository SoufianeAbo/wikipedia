<?php
session_start();

require_once './controllers/Tags_Controller.php';
require_once './controllers/Category_controller.php';
require_once './controllers/Wiki_controller.php';

$userController = new TagsController("localhost", "root", "", "wiki");
$categoryController = new CategoryController("localhost", "root", "", "wiki");
$wikiController = new WikiController("localhost", "root", "", "wiki");

// if (isset($_POST['tag'])) {
//     $userController->addTag($_POST['tag'], $_POST['tagCategory']);
// }

// if (isset($_POST['tagEdit'])) {
//     $userController->updateTags($_POST['tagEdit'], $_POST['tagName'], $_POST['tagCategory']);
// }

// if (isset($_POST['tagIdDelete'])) {
//     $userController->deleteTag($_POST['tagIdDelete']);
// }

if (isset($_POST['deleteWiki'])) {
    $wikiController->deleteWiki($_POST['deleteWiki']);
}

if (isset($_POST['tags'])) {
    $tagsString = $_POST['tags'];

    $title = $_POST['title'];
    $description = $_POST['description'];
    $tagCategory = $_POST['tagCategory'];

    $wikiController->addWiki($title, $description, $tagCategory, $_SESSION['id'], $tagsString);

    echo json_encode(['success' => true]);
} else {
    echo json_encode(['error' => 'Invalid request method']);
}

$tags = $userController->showTags();
$categories = $categoryController->showCategories();
$categoryNames = $categoryController->showCategoryNames();

$wikis = $wikiController->showWikiTags();

include "./views/dashboardWikis.php";
?>