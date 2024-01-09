<?php

require_once './controllers/User_controller.php';

$userController = new UserController("localhost", "root", "", "wiki");

if (isset($_GET['register'])) {
    $firstname = $_POST['register_firstname'];
    $lastname = $_POST['register_lastname'];
    $email = $_POST['register_email'];
    $password = $_POST['register_password'];

    if ($userController->register($firstname, $lastname, $email, $password)) {
        echo "Registration successful!";
        Header ("Location: ./index.php");
    } else {
        echo "Registration failed!";
    }
}

if (isset($_GET['login'])) {
    $username = $_POST['login_username'];
    $password = $_POST['login_password'];

    $userId = $userController->login($username, $password);

    if ($userId) {
        echo "Login successful! User ID: $userId";
        Header ("Location: ./index.php");
    } else {
        echo "Login failed!";
    }
}

include "./views/login.html";
?>