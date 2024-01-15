<?php

class TagsModel {
    private $conn;

    public function __construct($servername, $username, $password, $dbname) {
        $this->conn = new mysqli($servername, $username, $password, $dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function addTag($tagName, $tagCategory) {
        $sql = "INSERT INTO tags (tag, categoryId) VALUES ('$tagName', $tagCategory)";

        if ($this->conn->query($sql) === TRUE) {
            echo "Category added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }

    public function showTags() {
        $sql = "SELECT * FROM tags";
        
        $result = $this->conn->query($sql);
    
        if ($result !== false) {
            $tags = $result->fetch_all(MYSQLI_ASSOC);
    
            return $tags;
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }

    public function updateTag($tagId, $tagName, $tagCategory) {
        $sql = "UPDATE tags SET tag = '$tagName', categoryId = '$tagCategory' WHERE id = $tagId";

        if ($this->conn->query($sql) === TRUE) {
            echo "Category updated successfully";
        } else {
            echo "Error updating category: " . $this->conn->error;
        }
    }

    public function deleteTag($tagId) {
        $sql = "DELETE FROM tags WHERE id = $tagId";

        if ($this->conn->query($sql) === TRUE) {
            echo "Category updated successfully";
        } else {
            echo "Error updating category: " . $this->conn->error;
        }
    }
    
    public function getTagsCount() {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM tags");
        $stmt->execute();
        $stmt->bind_result($tagsCount);
    
        if ($stmt->fetch()) {
            $stmt->close();
            return $tagsCount;
        } else {
            $stmt->close();
            return 0;
        }
    }
    

    public function getTagsByCategory($categoryId) {
        $categoryId = mysqli_real_escape_string($this->conn, $categoryId);

        $sql = "SELECT id, tag FROM tags WHERE categoryId = $categoryId";
        $result = $this->conn->query($sql);
        
        if ($result !== false && $result->num_rows > 0) {
            $tags = array();

            while ($row = $result->fetch_assoc()) {
                $tags[] = $row;
            }

            
            return $tags;
        } else {
            return false;
        }
    }
    

    public function closeConnection() {
        $this->conn->close();
    }
}

?>