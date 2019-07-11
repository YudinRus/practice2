<?php

class CatalogController {
    
    public function actionIndex()
    {
        $categories = array();
        $categories = Category::getCategoriesList();
        
        $latestProducts = array();
        $latestProducts = Product::getLatestProducts();
        
        require_once(ROOT.'/views/catalog/index.php');
        
        return true;
    }
    
    public function actionCategory($categoryId, $page = 1)
    {
             
        $categories = array();
        $categories = Category::getCategoriesList();
        
        $categoryProducts = array();
        $categoryProducts = Product::getProductListByCategory($categoryId, $page);
        
        require_once(ROOT.'/views/catalog/category.php');
    }
           
}
