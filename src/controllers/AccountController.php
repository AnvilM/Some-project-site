<?php


namespace src\controllers;

use src\core\Controller;

Class AccountController extends Controller{
    public function IndexAction(){


        $this->view->render();
    }
    public function LoginAction(){
        if(isset($_POST['Login']) && isset($_POST['Password'])){
            $response = $this->model->getUser($_POST['Login'], hash('sha256', $_POST['Password']));
            if(mysqli_num_rows($response) >= 1){

                $_SESSION['Login'] = mysqli_fetch_assoc($response)['Login'];
                header('Location: /');
            }
            else{
                $this->SetMessage('Неверный логин или пароль');
                header('Location: /Account/Login');
            }
        }
        else{
            $this->view->render();
        }

    }

    public function SignupAction(){
        if(isset($_POST['Login']) && isset($_POST['Email']) && isset($_POST['Password']) && isset($_POST['Password_2'])){
            
            //LOGIN_VALIDATE
            if (strlen($_POST['Login'])<3){
                $this->SetMessage('Длина логина должна быть не менее 3 символов');
                header('Location: /Account/Signup');
                exit();
            }
            else if (strlen($_POST['Login'])>16){
                $this->SetMessage('Длина логина должна быть не более 16 символов');
                header('Location: /Account/Signup');
                exit();
            }
            if(preg_match('/[^0-9A-Za-z]/', $_POST['Login']) == true){

                $this->SetMessage('Логин может содержать только цифры и латинские буквы');
                header('Location: /Account/Signup');
                exit();
            }

            //EMAIL_VALIDATE
            if (!filter_var($_POST['Email'], FILTER_VALIDATE_EMAIL)|| strlen($_POST['Email'])<=0){
                $this->SetMessage('Некорректное значение Email');
                header('Location: /Account/Signup');
                exit();
            }

            //PASSWORD_VALIDATE
            if(strlen($_POST['Password']) <8){
                $this->SetMessage('Длина пароля должна быть не менее 8 символов');
                header('Location: /Account/Signup');
                exit();
            }
            if($_POST['Password'] !== $_POST['Password_2']){
                $this->SetMessage('Пароли не совпадают');
                header('Location: /Account/Signup');
                exit();
            }
            if(mysqli_num_rows($this->model->getLogin($_POST['Login'])) >= 1){
                $this->SetMessage('Логин занят');
                header('Location: /Account/Signup');
                exit();
            }
            if(mysqli_num_rows($this->model->getEmail($_POST['Email'])) >= 1){
                $this->SetMessage('Почта занята');
                header('Location: /Account/Signup');
                exit();
            }
            
            $code = rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9);

            $text = '
            <html>
                <body>
                    <div class="message" style="background-color: #1B1B22; border-radius: 10px; width: 400px; color: #fff; padding: 10px 20px; font-size: 18px; font-weight: 400;">
                        <div class="content">
                            <div class="logo" style="display: flex; align-items: center;">
                                <div class="icon" style="width: 30px; height: 30px; padding: 5px; border-radius: 10px; background-color: #5a5a5a4b;">
                                    <img src="https://yukkamc.ru/public/icons/logo.svg" alt="." style="width: 30px; height: 30px;">
                                </div>
                                <div class="title" style="font-size: 29px; margin-left: 10px; font-weight: 500;">
                                    YUKKA
                                </div>
                            </div>
                            <div class="description" style="text-align: center; margin-top: 20px;">
                                Код подтверждения,<br>необходимый для регистрации.
                            </div>
                            <div class="code" style="font-size: 32px; text-align: center; font-weight: 500; margin: 40px 0">
                                '.$code.'
                            </div>
                        </div>
                        <div class="description">
                            <div class="content" style="width: calc; border-radius: 10px; border: 1px #3f3f4e solid; display: flex; padding: 10px 20px;">
                                <div class="left" style="width: 45%;">
                                    Если это письмо адресовано не вам, пожалуйста, проигнорируйте его.
                                </div>
                                <div class="right" style="width: 45%; margin-left: auto; margin-right: 0;">
                                    Не имея данный код, другие пользователи не смогут привязать вашу почту, к своему аккаунту.
                                </div>
                            </div>
                        </div>
                    </div>
                </body>
            </html>';

            mail(
                $_POST['Email'],
                'Код подтверждения',
                $text,
                "From: MIME-Version: 1.0\r\n"
                ."Content-type: text/html; charset=utf-8\r\n"
                ."From: no-reply@yukkamc.ru\r\n"
                ."To: ".$_POST['Email']."\r\n"
                ."Cc: no-reply@yukkamc.ru\r\n"
                ."Bcc: no-reply@yukkamc.ru\r\n"
                ."X-Mailer: PHP/".phpversion()
            );

        
            
            $salt = 'ee1655cdc1';
            $code_hash = hash('sha256', $code);
            $code_replace = substr($code_hash, strlen($code_hash)/2 - 5, 10);
            $code_hash = str_replace($code_replace, $salt, $code_hash);
            $code_hash = str_replace('a', 'd', $code_hash);
            
            
            $_SESSION['Temp_Signup'] = [
                'Login' => $_POST['Login'],
                'Password' => $_POST['Password'],
                'Email' => $_POST['Email'],
                'Code_hash' => $code_hash
            ];
            
            $this->SetMessage('На вашу почту отправленно письмо');
            header('Location: /account/confirm');
                
        }
        else{
            $this->view->render();
        }
        
    }

    public function LogoutAction(){
        unset($_SESSION['Login']);
        header('Location: /');
    }

    public function SettingsAction(){

        $this->view->render();
    }

    public function SessionsAction(){

        $this->view->render();
    }

    public function ConfirmAction(){
    
        if(isset($_POST['Code'])){
            $code = $_POST['Code'];
            $salt = 'ee1655cdc1';
            $code_hash = hash('sha256', $code);
            $code_replace = substr($code_hash, strlen($code_hash)/2 - 5, 10);
            $code_hash = str_replace($code_replace, $salt, $code_hash);
            $code_hash = str_replace('a', 'd', $code_hash);

            if($_SESSION['Temp_Signup']['Code_hash'] === $code_hash){
                $this->model->AddUser($_SESSION['Temp_Signup']['Login'], hash('sha256', $_SESSION['Temp_Signup']['Password']), $_SESSION['Temp_Signup']['Email'], time());
                $_SESSION['Login'] = mysqli_fetch_assoc($this->model->getUser($_SESSION['Temp_Signup']['Login'], hash('sha256', $_SESSION['Temp_Signup']['Password'])))['Login'];
                unset($_SESSION['Temp_Signup']);
                header('Location: /');
            }
            else{
                $this->SetMessage('Код неверный');
                unset($_SESSION['Temp_Signup']);
                header('Location: /');
            }
            
        }
        else if(isset($_GET['help'])){
            $this->SetMessage('Проверьте папку спам');
            header('Location: /Account/Confirm');
        }
        else{
            $this->view->render();
        }

    }

    public function RecoveryAction(){
        if(isset($_POST['Login'])){
            $email = mysqli_fetch_assoc($this->model->getEmailFromLogin($_POST['Login']))['Email'];
            $code = rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9);
            $text = '
            <html>
                <body>
                    <div class="message" style="background-color: #1B1B22; border-radius: 10px; width: 400px; color: #fff; padding: 10px 20px; font-size: 18px; font-weight: 400;">
                        <div class="content">
                            <div class="logo" style="display: flex; align-items: center;">
                                <div class="icon" style="width: 30px; height: 30px; padding: 5px; border-radius: 10px; background-color: #5a5a5a4b;">
                                    <img src="https://yukkamc.ru/public/icons/logo.svg" alt="." style="width: 30px; height: 30px;">
                                </div>
                                <div class="title" style="font-size: 29px; margin-left: 10px; font-weight: 500;">
                                    YUKKA
                                </div>
                            </div>
                            <div class="description" style="text-align: center; margin-top: 20px;">
                                Для восстановления пароля<br>Нажмите кнопку
                            </div>
                            <div class="button" style="display: flex;">
                                <a href="https://yukkamc.ru/Account/Reset?token='.$code.'" style="margin-left: auto; margin-right: auto; text-align: center; display: flex; align-items: center;  margin-top: 40px; margin-bottom: 40px; border-radius: 6px; padding: 5px 20px; height: 30px; background-color: #6563eec9; cursor: pointer; text-decoration: none; color: #fff; font-weight: 400;">
                                    Восстановить
                                </a>
                            </div>
                        </div>
                        <div class="description">
                            <div class="content" style="width: calc; border-radius: 10px; border: 1px #3f3f4e solid; display: flex; padding: 10px 20px;">
                                <div class="left" style="">
                                    Если это письмо адресовано не вам, пожалуйста, проигнорируйте его.
                                </div>
                            </div>
                        </div>
                    </div>
                </body>
            </html>';

            mail(
                $email,
                'Код подтверждения',
                $text,
                "From: MIME-Version: 1.0\r\n"
                ."Content-type: text/html; charset=utf-8\r\n"
                ."From: no-reply@yukkamc.ru\r\n"
                ."To: ".$email."\r\n"
                ."Cc: no-reply@yukkamc.ru\r\n"
                ."Bcc: no-reply@yukkamc.ru\r\n"
                ."X-Mailer: PHP/".phpversion()
            );

        
            
            $salt = 'ee1655cdc1';
            $code_hash = hash('sha256', $code);
            $code_replace = substr($code_hash, strlen($code_hash)/2 - 5, 10);
            $code_hash = str_replace($code_replace, $salt, $code_hash);
            $code_hash = str_replace('a', 'd', $code_hash);

            $_SESSION['Temp_Recovery'] = [
                'Email' => $email,
                'code_hash' => $code_hash,
                
            ];

            
            $this->SetMessage('На вашу почту отправленно письмо');
            header('Location: /');

        }
        else if(isset($_GET['help'])){
            $this->SetMessage('Проверьте папку спам');
            header('Location: /Account/Recovery');
        }
        else{
            $this->view->render();
        }
        
        
    }

    public function ResetAction(){
        
        if(isset($_GET['token']) && $_SESSION['Temp_Recovery']['code_hash'] === $_GET['token']){
            if(isset($_POST['Password']) && isset($_POST['Password_2'])){
                if($_POST['Password'] === $_POST['Password_2']){
                    $this->model->updatePasswordFromEmail(hash('sha256', $_POST['Password']), $_SESSION['Temp_Recovery']['Email']);
                    $_SESSION['Login'] = mysqli_fetch_assoc($this->model->getUser($_SESSION['Temp_Recovery']['Email'], hash('sha256', $_POST['Password'])))['Login'];
                    header('Location: /');
                }
                else{
                    $this->SetMessage('Пароли не совпадают');
                    header('Location: /Account/Reset?token='.$_GET['token']);
                }
            }
            else{
                $this->view->render();
            }
        }
        else{
            $this->SetMessage('Неверный токен');
            unset($_SESSION['Temp_Recovery']);
            header('Location: /');
        }
        
    }
    


   

} 