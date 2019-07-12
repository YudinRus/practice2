<?php

class SiteController {
    
    public function actionIndex()
    {
        $categories = array();
        $categories = Category::getCategoriesList();
        
        $latestProducts = array();
        $latestProducts = Product::getLatestProducts();
        
        require_once(ROOT.'/views/site/index.php');
        
        return true;
    }
    
    public function actionContact()
    {
        $mail = 'php.start@mail.ru';
        $subject = 'Тема письма: ';
        $message = 'Тема письма: ';
        $result = mail($mail, $subject, $message);
        
        var_dump($result);
        
    }
}
