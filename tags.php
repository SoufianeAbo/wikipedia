<?php
require_once './controllers/Tags_Controller.php';
require_once './controllers/Category_controller.php';

$userController = new TagsController("localhost", "root", "", "wiki");
$categoryController = new CategoryController("localhost", "root", "", "wiki");

// if (isset($_POST['tag'])) {
//     $userController->addTag($_POST['tag']);
// }

// if (isset($_POST['categoryEdit'])) {
//     $userController->updateTags($_POST['categoryId'], $_POST['categoryEdit']);
// }

// if (isset($_POST['categoryIdDelete'])) {
//     $userController->deleteTag($_POST['categoryIdDelete']);
// }

if (isset($_POST['tag'])) {
    $userController->addTag($_POST['tag'], $_POST['tagCategory']);
}

if (isset($_POST['tagEdit'])) {
    $userController->updateTags($_POST['tagEdit'], $_POST['tagName'], $_POST['tagCategory']);
}

if (isset($_POST['tagIdDelete'])) {
    $userController->deleteTag($_POST['tagIdDelete']);
}

$tags = $userController->showTags();
$categories = $categoryController->showCategories();
$categoryNames = $categoryController->showCategoryNames();


include './views/dashboardTags.php';
?>