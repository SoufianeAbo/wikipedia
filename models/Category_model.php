<?php

class CategoryModel {
    private $conn;

    public function __construct($servername, $username, $password, $dbname) {
        $this->conn = new mysqli($servername, $username, $password, $dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function addCategory($categoryName) {
        $categoryName = trim(htmlspecialchars($categoryName));

        $sql = "INSERT INTO categories (name) VALUES ('$categoryName')";

        if ($this->conn->query($sql) === TRUE) {
            echo "Category added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }

    public function showCategories() {
        $sql = "SELECT * FROM categories";
        
        $result = $this->conn->query($sql);
    
        if ($result !== false) {
            $categories = $result->fetch_all(MYSQLI_ASSOC);
    
            return $categories;
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }

    public function updateCategory($categoryId, $newCategoryName) {
        $categoryId = (int)$categoryId;
        $newCategoryName = trim(htmlspecialchars($newCategoryName));

        $sql = "UPDATE categories SET name = '$newCategoryName' WHERE id = $categoryId";

        if ($this->conn->query($sql) === TRUE) {
            echo "Category updated successfully";
        } else {
            echo "Error updating category: " . $this->conn->error;
        }
    }

    public function deleteCategory($categoryId) {
        $categoryId = (int)$categoryId;

        $sql = "DELETE FROM categories WHERE id = $categoryId";

        if ($this->conn->query($sql) === TRUE) {
            echo "Category updated successfully";
        } else {
            echo "Error updating category: " . $this->conn->error;
        }
    }

    public function showCategoryNames() {
        $sql = "SELECT id, name FROM categories";

        $result = $this->conn->query($sql);

        if ($result !== false) {
            $categories = array();

            while ($row = $result->fetch_assoc()) {
                $categories[$row['id']] = $row['name'];
            }

            return $categories;
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }
    

    public function closeConnection() {
        $this->conn->close();
    }
}

?>