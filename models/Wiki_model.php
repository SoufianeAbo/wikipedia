<?php

class WikiModel {
    private $conn;

    public function __construct($servername, $username, $password, $dbname) {
        $this->conn = new mysqli($servername, $username, $password, $dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function addWiki($title, $description, $categoryId, $creatorId) {
        $currentDate = date('Y-m-d');
        $currentHour = date('H:i:s');

        $query = "INSERT INTO wiki (title, description, categoryId, creatorId, dateofCreation, hourofCreation) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssiiss", $title, $description, $categoryId, $creatorId, $currentDate, $currentHour);
        $stmt->execute();
        $stmt->close();

        return $this->conn->insert_id;
    }

    public function updateWiki($wikiId, $title, $description, $categoryId, $creatorId) {
        $currentDate = date('Y-m-d');
        $currentHour = date('H:i:s');

        $query = "UPDATE wiki SET title = ?, description = ?, categoryId = ?, creatorId = ?, dateofCreation = ?, hourofCreation = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssiissi", $title, $description, $categoryId, $creatorId, $currentDate, $currentHour, $wikiId);
        $stmt->execute();
        $stmt->close();

        return $this->conn->insert_id;
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

    public function addTagsToWiki($wikiId, $tagIds) {
        $query = "INSERT INTO wikitags (wiki_id, tag_id) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
    
        $tagArray = explode(',', $tagIds);
        foreach ($tagArray as $tagId) {
            $tagId = trim($tagId);
            $stmt->bind_param("ii", $wikiId, $tagId);
            $stmt->execute();
        }
    
        $stmt->close();
    }

    public function updateTagsToWiki($wikiId, $tagIds) {
        $deleteQuery = "DELETE FROM wikitags WHERE wiki_id = ?";
        $deleteStmt = $this->conn->prepare($deleteQuery);
        $deleteStmt->bind_param("i", $wikiId);
        $deleteStmt->execute();
        $deleteStmt->close();
    
        $insertQuery = "INSERT INTO wikitags (wiki_id, tag_id) VALUES (?, ?)";
        $insertStmt = $this->conn->prepare($insertQuery);
    
        $tagArray = explode(',', $tagIds);
        foreach ($tagArray as $tagId) {
            $tagId = trim($tagId);
            $insertStmt->bind_param("ii", $wikiId, $tagId);
            $insertStmt->execute();
        }
    
        $insertStmt->close();
    }    

    public function showWikiWithTags($dateTrue = null) {
        $sql = "SELECT wiki.*, wikitags.tag_id, tags.tag, categories.name, users.firstName, users.lastName
        FROM wiki
        LEFT JOIN wikitags ON wiki.id = wikitags.wiki_id
        LEFT JOIN tags ON wikitags.tag_id = tags.id
        LEFT JOIN categories ON wiki.categoryId = categories.id
        LEFT JOIN users ON wiki.creatorId = users.id
        WHERE wiki.archive = 0";

        if ($dateTrue) {
            $sql .= " GROUP BY wiki.id ORDER BY wiki.dateofCreation DESC, wiki.hourOfCreation DESC LIMIT 5";
        }

        
        $result = $this->conn->query($sql);
    
        if ($result !== false) {
            $data = array();
    
            while ($row = $result->fetch_assoc()) {
                $data[$row['id']]['wiki'] = $row;
                $data[$row['id']]['tags'][] = $row['tag'];
            }
    
            return $data;
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }
    
    public function deleteWiki($wiki) {
        $sql = "DELETE FROM wiki WHERE id = $wiki";

        if ($this->conn->query($sql) === TRUE) {
            echo "Category updated successfully";
        } else {
            echo "Error updating category: " . $this->conn->error;
        }
    }

    public function archiveWiki($wiki) {
        $archive = 1;

        $query = "UPDATE wiki SET archive = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $archive, $wiki);
        $stmt->execute();
        $stmt->close();

        return $this->conn->insert_id;
    }
}

?>