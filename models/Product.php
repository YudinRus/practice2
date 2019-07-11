<?php

class Product {
    
    const SHOW_BY_DEFAULT = 6;
    
    public static function getLatestProducts($count = self::SHOW_BY_DEFAULT)
    {
        $count = intval($count);
        
        $db = Db::getConnection();
        
        $productsList = array();
        
        $result = $db->query('SELECT id, name, price, image, is_new FROM product WHERE status="1" ORDER BY id DESC limit 6');
       
           
        $i = 0;
        while ($row = $result->fetch()) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['image'] = $row['image'];
            $productsList[$i]['price'] = $row['price'];
            $productsList[$i]['is_new'] = $row['is_new'];
            $i++;
        }
        return $productsList;
    }
    
    public static function getProductListByCategory($categoryId = false, $page = 1)
    {
        if($categoryId)
        {
            $page = intval($page);
            //$offset = ($page - 1) * self::SHOW_BY_DEFAULT;
                        
            $db = Db::getConnection();
        
            $products = array();
        
            $result = $db->query("select id, name, price, image, is_new from product where status='1' and category_id='$categoryId' order by id");
            
                       
            $i=0;
            while($row = $result->fetch())
            {
                $products[$i]['id'] = $row['id'];
                $products[$i]['name'] = $row['name'];
                $products[$i]['image'] = $row['image'];
                $products[$i]['is_new'] = $row['is_new'];
                $products[$i]['price'] = $row['price'];
                $i++;
            }
            return $products;
        }
        
    }
    
    public static function getProductById($id)
    {
        $id = intval($id);
        
        if($id)
        {
            $db = Db::getConnection();
            
            $result = $db->query('select * from product where id='.$id);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            
            return $result->fetch();
        }
    }
}
