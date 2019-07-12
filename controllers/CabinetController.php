<?php

class CabinetController {
    
    public function actionIndex()
    {
        // Получаем идентификатор пользователя из сессии
        $userId = User::chekLogged();
        
        // Получаем информацию о пользователе из БД
        $user = User::getUserById($userId);
        
       
        require_once (ROOT.'/views/cabinet/index.php');
        
        return true;
    }
    
    public function actionEdit()
    {
        // Получаем идентификатор пользователя из сессии
        $userId = User::chekLogged();
        
        // Получаем информацию о пользователе из БД
        $user = User::getUserById($userId);
        
        $name = $user['name'];
        $password = $user['password'];
        
        $result = false;
        
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $password = $_POST['password'];
            
            $errors = FALSE;
            
            if (!User::chekName($name)) {
                $errors[] = 'Имя не должно быть короче 2-х символов';
            }
            
            if (!User::chekPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }
            
            if ($errors == FALSE) {
                $result = User::edit($userId, $name, $password);
            }
        }
        
        require_once(ROOT.'/views/cabinet/edit.php');
        
        return true;
    }
}
