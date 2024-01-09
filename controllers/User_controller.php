<?php

require_once './models/User_model.php';

class UserController {
    private $userModel;

    public function __construct($host, $username, $password, $database) {
        $this->userModel = new UserModel($host, $username, $password, $database);
    }

    public function register($firstname, $lastname, $email, $password) {
        return $this->userModel->registerUser($firstname, $lastname, $email, $password);
    }

    public function login($username, $password) {
        return $this->userModel->loginUser($username, $password);
    }

    public function closeConnection() {
        $this->userModel->closeConnection();
    }
}
?>