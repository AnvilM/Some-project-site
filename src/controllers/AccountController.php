<?php


namespace src\controllers;

use src\core\Controller;

Class AccountController extends Controller{
    public function IndexAction(){
        
        $this->view->render();
    }
    public function LoginAction(){
        if(isset($_GET['code'])){
            $this->DiscordAuth();
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

    public function LogoutAction(){
        unset($_SESSION['Login']);
        header('Location: /');
        exit();
    }



    private function DiscordAuth(){
        $discord = require $_SERVER['DOCUMENT_ROOT'].'/src/config/discord.php';
            $data = [
                'client_id' => $discord['client_id'],
                'client_secret' => $discord['client_secret'],
                'grant_type' => 'authorization_code',
                'code' => $_GET['code'],
                'redirect_uri' => $discord['redirect_uri'],
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

            $_SESSION['Login'] = $response['username'].'#'.$response['discriminator'];
            header('Location: /');
            exit();
    }
} 