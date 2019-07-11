<?php

class UserController {
    
    public function actionRegister()
    {
        $name = '';
        $email = '';
        $password = '';
        
        if(isset($_POST['submit'])) 
        {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            $errors = false;
        
            if(!User::chekName($name)) {
                $errors[] = 'Имя не должно быть короче 2-x символов';
            }

            if(!User::chekEmail($email)) {
                $errors[] = 'Неправильный Email';
            }

            if(!User::chekPassword($password)) {
                $errors[]= 'Пароль не должен быть короче 6-ти символов';
            }
            
            if(User::chekEmailExists($email)) {
                $errors[] = 'Такой email уже сущеситвует';
            }
            
            if($errors == false) {
                $result = User::register($name, $email, $password);
            }
            
        }
                     
        require_once(ROOT.'/views/user/register.php');
        
        return true;;
    }
    
     public function actionLogin()
        {
            $email = '';
            $password = '';
            
            if (isset($_POST['submit']))
            {
                $email = $_POST['email'];
                $password = $_POST['password'];
                
                $errors = false;
                
                //Валидация полей 
                if (!User::chekEmail($email)) {
                    $errors[] = 'Неправильный email';
                }
                
                if (!User::chekPassword($password)) {
                    $errors[] = 'Пароль не должен быть короче 6-ти символов';
                }
                
                // проверяем, существует ли пользователь
                $userId = User::chekUserData($email, $password);
                
                if ($userId == false) {
                    // Если данные неправильные - показываем ошибку
                    $errors[] = 'Неправильные данные для входа на сайт';
                } else {
                    // Если данные правильные - запоминаем пользователя (сессия)
                    User::auth($userId);
                    
                    // Перенаправляем пользователя в закрытую часть - кабинет
                    header("Location: /cabinet/");
                }
               
            }
            
            require_once (ROOT.'/views/user/login.php');
            
            return true;
            
        }
        
        /*
         * Удаляем данные о пользователе из сессии
         */
        public function actionLogout()
        {
            unset($_SESSION['user']);
            header("Location: /");
        }
}
