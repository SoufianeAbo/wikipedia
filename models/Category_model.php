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

        $currentDate = date('Y-m-d');
        $currentHour = date('H:i:s');

        $sql = "INSERT INTO categories (name, dateofCreation, hourofCreation) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $categoryName, $currentDate, $currentHour);

        if ($stmt->execute()) {
            echo "Category added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $stmt->error;
        }

        $stmt->close();
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

        $currentDate = date('Y-m-d');
        $currentHour = date('H:i:s');

        $sql = "UPDATE categories SET name = ?, dateofCreation = ?, hourofCreation = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssi", $newCategoryName, $currentDate, $currentHour, $categoryId);

        if ($stmt->execute()) {
            echo "Category updated successfully";
        } else {
            echo "Error updating category: " . $stmt->error;
        }

        $stmt->close();
    }

    public function deleteCategory($categoryId) {
        $categoryId = (int)$categoryId;

        $sql = "DELETE FROM categories WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $categoryId);

        if ($stmt->execute()) {
            echo "Category deleted successfully";
        } else {
            echo "Error deleting category: " . $stmt->error;
        }

        $stmt->close();
    }

    public function showCategoryNames($date = null) {
        $sql = "SELECT id, name FROM categories";

        if ($date) {
            $sql .= " GROUP BY id ORDER BY dateofCreation DESC, hourOfCreation DESC LIMIT 5";
        }

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

    public function getCategoriesCount() {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM users");
        $stmt->execute();
        $stmt->bind_result($categoriesCount);
    
        if ($stmt->fetch()) {
            $stmt->close();
            return $categoriesCount;
        } else {
            $stmt->close();
            return 0;
        }
    }
    

    public function closeConnection() {
        $this->conn->close();
    }
}

?>
