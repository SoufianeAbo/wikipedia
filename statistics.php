<?php
require_once './controllers/Wiki_controller.php';
require_once './controllers/User_controller.php';
require_once './controllers/Tags_controller.php';
require_once './controllers/Category_controller.php';

$userController = new UserController("localhost", "root", "", "wiki");
$categoryController = new CategoryController("localhost", "root", "", "wiki");
$wikiController = new WikiController("localhost", "root", "", "wiki");
$tagsController = new TagsController("localhost", "root", "", "wiki");

$userCount = $userController->getCount();
$categoryCount = $categoryController->getCount();
$wikiCount = $wikiController->getCount();
$tagsCount = $tagsController->getCount();


include './views/statistics.php';
?>