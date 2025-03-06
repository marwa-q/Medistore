<?php
require_once __DIR__ . "/../../models/Category.php";

class CategoryController
{

    private $productCategory;

    public function __construct($database)
    {
        $this->productCategory = new Category($database);
    }


    // public function showCategory()
    // {
    //     $categories = $this->productCategory->getAllCategories(); // جلب الفئات من قاعدة البيانات
    //     foreach ($categories as $category) {
    //         echo $category;
    //     }
    //     require __DIR__ . "/../../views/category.php"; // تحميل الصفحة مع تمرير البيانات
    // }
}
