<?php
require_once './controllers/Category_controller.php';
$userController = new CategoryController("localhost", "root", "", "wiki");

if (isset($_POST['category'])) {
    $userController->addCategory($_POST['category']);
}

if (isset($_POST['categoryEdit'])) {
    $userController->updateCategories($_POST['categoryId'], $_POST['categoryEdit']);
}

if (isset($_POST['categoryIdDelete'])) {
    $userController->deleteCategory($_POST['categoryIdDelete']);
}

$categories = $userController->showCategories();


include './views/dashboardAdmin.php';
?>