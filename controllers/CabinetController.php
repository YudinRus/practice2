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
}
