<?php
require_once __DIR__ . "/../models/categoryModel.php";

class CategoryController
{

    private $productCategory;

    public function __construct($database)
    {
        $this->productCategory = new Category($database);
    }


    public function showCategory()
    {
        $categories = $this->productCategory->getAllCategories(); // جلب الفئات من قاعدة البيانات
        foreach($categories as $category){
            echo $category;
        }
        require __DIR__ . "/../views/Category.php"; // تحميل الصفحة مع تمرير البيانات
    }
    
    

    
    

}
/* ublic function showCategories()
{
    // الحصول على جميع الفئات من قاعدة البيانات
    $categories = $this->categoryModel->getAllCategories();

    // عرض الـ View مع تمرير الفئات إليها
    require __DIR__ . "/../views/category_dropdown.php"; 
}

<?php
public function showCategories() {
        $stmt = $this->productCategory->prepare("SELECT * FROM categories");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        require __DIR__ . "/../views/Category.php";
    }
require_once __DIR__ . "/../models/Product.php";

class ProductController
{
    private $productModel;
    private $category;

    public function __construct($database)
    {
        $this->productModel = new Product($database);
    }

     public function showProducts()
    {
        $products = $this->productModel->getAllProducts();
        require __DIR__ . "/../views/products.php"; // Load the products view
    }*/
?>
