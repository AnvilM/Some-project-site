<?php


namespace src\controllers;

use src\core\Controller;

Class AccountController extends Controller{
    public function IndexAction(){
        
        $this->view->render();
    }
    public function LoginAction(){
        if(isset($_POST['login']) && isset($_POST['password'])){
            //Запрос к бд и установка сессии и всей остальной херни
        }
        
        $this->view->render();
    }
    public function SignupAction(){
        if(isset($_POST['login']) && isset($_POST['password'])){
            //Отправка кода подтверждения и переход на страницу подтверждения
        }

        $this->view->render();
    }
} 