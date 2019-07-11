<?php

class User {
    
    public static function  register($name, $email, $password)
    {
        $db = Db::getConnection();
        
        $sql = 'insert into user (name, email, password) values (:name, :email, :password)';
        
        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        
        return $result->execute();
    }
    
    /*
     * Запоминаем пользователя
     * @param string $email
     * @param string $password
     */
    public static function auth($userId)
    {
        $_SESSION['user'] = $userId;
    }
    
    
    public static function chekLogged()
    {
        // Если сессия есть, вернем идентификатор пользователя
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }
        
        header("Location: /user/login");
    }
    
    
    public static function isGuest()
    {
        if (isset($_SESSION['user'])) {
            return false;
        }
        return true;
    }
    
    
    /*
     * Проверяем имя: не меньше, чем 2 символа
     */
    public static function chekName($name)
    {
        if(strlen($name) >= 2)
        {
            return true;
        }
        return false;
    }
    
    /*
     * Проверяем пароль: не меньше чем 6 символов
     */
    public static function chekPassword($password)
    {
        if(strlen($password) >= 6)
        {
            return true;
        }
        return false;
    }
    
    /*
     * Проверяем мыло
     */
    public static function chekEmail($email)
    {
        if(filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            return true;;
        }
        return false;
    }
    
    public static function chekEmailExists($email)
    {
        $db = Db::getConnection();
        
        $sql = 'select count(*) from user where email = :email';
        
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();
        
        if ($result->fetchColumn()) {
            return true;
        }
        return false;
    }
    
    public static function chekUserData($email, $password)
    {
        $db = Db::getConnection();
        
        $sql = 'select * from user where email = :email and password = :password';
        
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_INT);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->execute();
        
        $user = $result->fetch();
        if ($user) {
            return user['id'];
        }
        return false;
    }
    
    public static function getUserById($id)
    {
        if ($id)
        {
            $db = Db::getConnection();
            $sql = 'select * from user where id = :id';
            
            $result = $db->query($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);
            
            // Указываем, что хотим получить данные в виде массива
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result->execute();
            
            return $result->fetch();
        }
    }
}
