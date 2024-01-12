<?php
require_once('./models/Tags_model.php');

class TagsController {
    private $tagsModel;

    public function __construct() {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "wiki";

        $this->tagsModel = new TagsModel($servername, $username, $password, $dbname);
    }

    public function addTag($tagName, $tagCategory) {
        $this->tagsModel->addTag($tagName, $tagCategory);
    }

    public function showTags() {
        return $this->tagsModel->showTags();
    }

    public function updateTags($tagId, $tagName, $tagCategory) {
        $this->tagsModel->updateTag($tagId, $tagName, $tagCategory);
    }

    public function deleteTag($tagId) {
        $this->tagsModel->deleteTag($tagId);
    }
}
?>