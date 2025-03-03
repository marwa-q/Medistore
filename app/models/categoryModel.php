<?php
class Category {

    private $DB;


    public function __construct($database)
    {
        $this->DB = $database;
    }

    // دالة لجلب جميع الفئات من قاعدة البيانات
    public function getAllCategories()
    {
        $stmt = $this->DB->prepare("SELECT * FROM categories");
        echo $stmt;
        if($stmt->execute()){
            return $stmt->fetchAll(); 
        }else{
            echo $stmt;
        }
        // return $stmt->fetchAll();  // إرجاع الفئات على شكل مصفوفة
    }



    public function getProductsByCategory($categoryId)
    {
        $query = "SELECT * FROM categories";
        if ($categoryId) {
            $query .= " WHERE category_id = :category_id";
        }
        $stmt = $this->DB->prepare($query);
        if ($categoryId) {
            $stmt->bindParam(":category_id", $categoryId, PDO::PARAM_INT);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>
