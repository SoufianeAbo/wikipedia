<?php

class UserModel {
    private $db;

    public function __construct($host, $username, $password, $database) {
        $this->db = new mysqli($host, $username, $password, $database);

        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
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
        $stmt = $this->db->prepare("SELECT id, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($userId, $hashedPassword);

        if ($stmt->fetch() && password_verify($password, $hashedPassword)) {
            $stmt->close();
            return $userId;
        } else {
            $stmt->close();
            return false;
        }
    }

    public function closeConnection() {
        $this->db->close();
    }
}
?>