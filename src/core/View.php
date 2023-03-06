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
        }
        else{
            header('Location: /Error/404');
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