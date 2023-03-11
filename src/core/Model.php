<?php

namespace src\core;

use src\lib\Db;
abstract class Model{
    
    public $db;
    
    public function __construct(){
        $this->db = new Db;
        
    }

    public function updateSession($Date, $Login, $SessionId,){
        $this->db->query("UPDATE `session` SET `LastActive` = '$Date' WHERE `Login` = '$Login' AND `SessionId` = '$SessionId'");
    }
}
