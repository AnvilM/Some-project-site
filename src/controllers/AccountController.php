<?php


namespace src\controllers;

use src\core\Controller;

Class AccountController extends Controller{
    public function IndexAction(){


        $this->view->render();
    }
    public function LoginAction(){

        if(isset($_GET['code'])){
            $DiscordLogin = $this->DiscordAuth();
            
            if(mysqli_num_rows($this->model->getLogin($DiscordLogin)) <= 0){
                $this->model->AddUser($DiscordLogin, NULL, NULL, time());
                $_SESSION['Login'] = $DiscordLogin;
                header('Location: /');
                exit();
            }
            else{
                $this->SetMessage('Логин занят');
                header('Location: /');
                exit();
            }
            
            
        }

        if(isset($_POST['Login']) && isset($_POST['Password'])){

            if(mysqli_num_rows($this->model->getUser($_POST['Login'], hash('sha256', $_POST['Password']))) >= 1){
                $_SESSION['Login'] = $_POST['Login'];
                header('Location: /');
                exit();
            }
            else{
                $this->SetMessage('Неверный логин или пароль');
            }


        
        }
        
        $this->view->render();
    }


    public function SignupAction(){
        if(isset($_POST['Login']) && isset($_POST['Password']) && isset($_POST['Email']) && isset($_POST['Password_2'])){
        
            
            if(strlen($_POST['Login']) >= 3 && strlen($_POST['Login']) <= 16 && mb_substr($_POST['Login'], 0, 0) != '-' && $_POST['Password'] == $_POST['Password_2'] && strlen($_POST['Password']) >= 8){
                if(mysqli_num_rows($this->model->getLogin($_POST['Login'])) < 1){
                    if(mysqli_num_rows($this->model->getEmail($_POST['Email'])) < 1){
                        $this->model->AddUser($_POST['Login'], hash('sha256', $_POST['Password']), $_POST['Email'], time());
                        $_SESSION['Login'] = $_POST['Login'];
                        header('Location: /');
                    }
                    else{
                        $this->SetMessage('Почта уже зарегестрированна');
                    }
                }
                else{
                    $this->SetMessage('Логин занят');
                }
            }


            //Отправка кода подтверждения и переход на страницу подтверждения
        }

        $this->view->render();
    }

    public function LogoutAction(){
        unset($_SESSION['Login']);
        header('Location: /');
        exit();
    }


    public function SettingsAction(){
        $this->view->render();
    }
    public function SessionsAction(){
        $this->view->render();
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

        
            return $response['username'];
    }

} 