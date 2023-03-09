<?php


namespace src\controllers;

use src\core\Controller;

Class AccountController extends Controller{
    public function IndexAction(){
        
        $this->view->render();
    }
    public function LoginAction(){
        if(isset($_GET['code'])){
            
            
            $data = [
                'client_id' => '1006565061214621808',
                'client_secret' => 'WYbuvoDs1O1i_hnxw8wvgksvE6_c7YxA',
                'grant_type' => 'authorization_code',
                'code' => $_GET['code'],
                'redirect_uri' => 'http://localhost/account/login',
                'scope' => 'identify%20guids',
            ]; 

            $data_string = http_build_query($data);
            $discord_token = 'https://discord.com/api/oauth2/token';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $discord_token);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            
            $response = json_decode(curl_exec($ch), true);
            
            

            $access_token = $response['access_token'];
            $discord_users_uri = "https://discord.com/api/users/@me";
            $header = array("Authorization: Bearer $access_token", "Content-type: application/x-www-form-urlencoded");
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch, CURLOPT_URL, $discord_users_uri);
            curl_setopt($ch, CURLOPT_POST, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            
            $response = json_decode(curl_exec($ch), true);

            $_SESSION["Login"] = $response['username'];
            header('Location: /');
            exit();
            
        }
        if(isset($_POST['login']) && isset($_POST['password'])){
            $_SESSION['Login'] = $_POST['login'];
            header('Location: /');

            
            //Запрос к бд и установка сессии и всей остальной херни
        }
        
        $this->view->render();
    }
    public function SignupAction(){
        if(isset($_POST['login']) && isset($_POST['password'])){
            $_SESSION['Login'] = $_POST['login'];
            header('Location: /');


            //Отправка кода подтверждения и переход на страницу подтверждения
        }

        $this->view->render();
    }
} 