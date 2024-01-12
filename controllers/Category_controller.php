<?php
require_once('./models/Category_model.php');

class CategoryController {
    private $categoryModel;

    public function __construct() {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "wiki";

        $this->categoryModel = new CategoryModel($servername, $username, $password, $dbname);
    }

    public function addCategory($categoryName) {
        $this->categoryModel->addCategory($categoryName);
    }

    public function showCategories() {
        return $this->categoryModel->showCategories();
    }

    public function updateCategories($categoryId, $categoryName) {
        $this->categoryModel->updateCategory($categoryId, $categoryName);
    }

    public function deleteCategory($categoryId) {
        $this->categoryModel->deleteCategory($categoryId);
    }

    public function showCategoryNames() {
        return $this->categoryModel->showCategoryNames();
    }
}
?>