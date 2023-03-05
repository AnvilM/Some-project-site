<?php


namespace src\controllers;

use src\core\Controller;


Class HomeController extends Controller{

    public function IndexAction(){
        $vars = [];
        if(isset($_SESSION['Login'])){
            $vars = [
                'nav-bar' => [
                    '<a href="/" class="button interactive-element">Аккаунт</a>'
                ]
            ];
        }
        else{
            $vars = [
                'nav-bar' => [
                    '<a href="/" class="button interactive-element">Войти</a>'
                ]
            ];
        }
        
        $this->view->render($vars);
    }   

} 