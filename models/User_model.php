<?php

class UserModel {
    private $db;

    public function __construct($host, $username, $password, $database) {
        $this->db = new mysqli($host, $username, $password, $database);

        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }

        session_start();
    }

    public function registerUser($firstname, $lastname, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $role = "auteur";

        $stmt = $this->db->prepare("INSERT INTO users (firstname, lastname, email, role, password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $firstname, $lastname, $email, $role, $hashedPassword);
        
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }
    }

    public function loginUser($username, $password) {
        $stmt = $this->db->prepare("SELECT id, password, firstName, lastName, role, email FROM users WHERE email = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($userId, $hashedPassword, $firstName, $lastName, $role, $email);

        if ($stmt->fetch() && password_verify($password, $hashedPassword)) {
            $stmt->close();

            $_SESSION['id'] = $userId;
            $_SESSION['firstName'] = $firstName;
            $_SESSION['lastName'] = $lastName;
            $_SESSION['role'] = $role;
            $_SESSION['email'] = $email;
            
            return $userId;
        } else {
            $stmt->close();
            return false;
        }
    }

    public function logout() {
        session_unset();
        session_destroy();
    }

    public function closeConnection() {
        $this->db->close();
    }
}
?>