<?php

class WikiModel {
    private $conn;

    public function __construct($servername, $username, $password, $dbname) {
        $this->conn = new mysqli($servername, $username, $password, $dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function addWiki($wikiTitle, $wikiDescription, $wikiCreatorId, $wikiCategoryId) {
        $sql = "INSERT INTO wiki (title, description, creatorId, categoryId) VALUES ('$wikiTitle', '$wikiDescription', $wikiCreatorId, $wikiCategoryId)";

        if ($this->conn->query($sql) === TRUE) {
            echo "Category added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }

    public function showWiki() {
        $sql = "SELECT * FROM wiki";
        
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
    

    public function closeConnection() {
        $this->conn->close();
    }
}

?>