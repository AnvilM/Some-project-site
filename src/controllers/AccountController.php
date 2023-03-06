<?php


namespace src\controllers;

use src\core\Controller;

Class AccountController extends Controller{

    public function LoginAction(){
        
        $this->view->render();
    }
    public function SignupAction(){
        echo 'Signup page';
    }
} 