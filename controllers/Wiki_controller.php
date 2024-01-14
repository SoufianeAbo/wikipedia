<?php
require_once './models/Wiki_model.php';

class WikiController {
    private $wikiModel;

    public function __construct($host, $username, $password, $database) {
        $this->wikiModel = new WikiModel($host, $username, $password, $database);
    }

    public function addWiki($title, $description, $categoryId, $creatorId, $tagIds) {
        $wikiId = $this->wikiModel->addWiki($title, $description, $categoryId, $creatorId);
        $this->wikiModel->addTagsToWiki($wikiId, $tagIds);
    }

    public function showWiki() {
        return $this->wikiModel->showWiki();
    }

    public function showWikiTags($date = null) {
        return $this->wikiModel->showWikiWithTags($date);
    }

    public function deleteWiki($wiki) {
        $this->wikiModel->deleteWiki($wiki);
    }

    public function archiveWiki($wiki) {
        $this->wikiModel->archiveWiki($wiki);
    }

    public function updateWiki($wikiId, $title, $description, $categoryId, $creatorId, $tagIds) {
        $this->wikiModel->updateWiki($wikiId, $title, $description, $categoryId, $creatorId, $tagIds);
        $this->wikiModel->updateTagsToWiki($wikiId, $tagIds);
    }
}

?>