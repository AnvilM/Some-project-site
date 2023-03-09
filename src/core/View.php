<?php

namespace src\core;

class View{

    public $params = [];

    function __construct($params){
        $this->params = $params;
    }

    public function render($vars=[]){
        $view = 'src/views/'.$this->params['Controller'].'/'.$this->params['View'].'.php';
        if(file_exists($view)){

            $title = $this->params['Title'];
            $css = $_SERVER['DOCUMENT_ROOT'].'/public/css/'.$this->params['Controller'].'/'.$this->params['View'].'.css';
            $js = $_SERVER['DOCUMENT_ROOT'].'/public/js/'.$this->params['Controller'].'/'.$this->params['View'].'.js';

            if(!file_exists($css)){
                $css = '';
            } else{
                $css = '<link rel="stylesheet" href="/public/css/'.$this->params['Controller'].'/'.$this->params['View'].'.css">';
            }   
            if(!file_exists($js)){
                $js = '';
            } else{
                $js = '<script src="/public/js/'.$this->params['Controller'].'/'.$this->params['View'].'.js"></script>';
            }
            
        

            $vars['navBar'] = $this->navBar();
           
            
            ob_start();
            require $view;
            $view = ob_get_clean();
            
            require 'src/views/Layout/'.$this->params['Layout'].'.php';
            
            $this->getMessage();
        }
        else{
            header('Location: /Error/404');
        }

        
    }

    public function getMessage(){
        if(isset($_SESSION['Message'])){
            echo '<div class="message" id="message">
                '.$_SESSION['Message'].'
                <script>
                    let mess = document.getElementById("message")

                    setTimeout(() => mess.classList.add("messageHide"), 6000);
                </script>
                <style>
                    .message{
                    position: fixed;
                    bottom: 20px;
                    left: 20px;

                    max-width: 300px;

                    border-radius: 6px;
                    border: 1px #3f3f4e solid;
                    padding: 10px 20px;
                    color: white;

                    transition: .4s ease-out left;
                }
                .messageHide{
                    left: -350px;
                }
                </style>
            </div>';

            unset($_SESSION['Message']);
        }
    }




    public function navBar(){
        $navBar = require $_SERVER['DOCUMENT_ROOT'].'/src/config/navbar.php';
        $navBar = $navBar[$this->params['Route']];
        $elems = [];
        foreach($navBar['all'] as $element){
            array_push($elems, $element);
        }
        if(isset($_SESSION['admin'])){
            foreach($navBar['admin'] as $element){
                array_push($elems, $element);
            }
        }
        if(isset($_SESSION['Login'])){
            foreach($navBar['isLogined'] as $element){
                array_push($elems, $element);
            }
        }
        else if(!isset($_SESSION['Login'])){
            foreach($navBar['noLogined'] as $element){
                array_push($elems, $element);
            }
        }

        return $elems;
        

    }

    public static function error($code){
        http_response_code($code);
        require $_SERVER['DOCUMENT_ROOT'].'/src/views/Error/'.$code.'.php';
        exit();
    }

    
    

}