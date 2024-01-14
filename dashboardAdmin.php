<?php
require_once './controllers/Category_controller.php';
require_once './controllers/User_controller.php';

$categoryController = new CategoryController("localhost", "root", "", "wiki");
$userController = new UserController("localhost", "root", "", "wiki");

if (isset($_POST['category'])) {
    $categoryController->addCategory($_POST['category']);
}

if (isset($_POST['categoryEdit'])) {
    $categoryController->updateCategories($_POST['categoryId'], $_POST['categoryEdit']);
}

if (isset($_POST['categoryIdDelete'])) {
    $categoryController->deleteCategory($_POST['categoryIdDelete']);
}

$categories = $categoryController->showCategories();

if (isset($_GET['logout'])) {
    $userController->logout();
    Header ("Location: ../index.php");
} else {
    include './views/dashboardAdmin.php';
}
?>