<?php


namespace src\controllers;

use src\core\Controller;

Class AccountController extends Controller{

    public function LoginAction(){
        $_SESSION['Login'] = 'Pebir';
        $this->view->render();
    }
    public function SignupAction(){
        unset($_SESSION['Login']);
        echo 'Signup page';
    }
} 