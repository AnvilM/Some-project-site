<?php

namespace src\models;

use Exception;
use src\core\Model;

class AccountModel extends Model{
    

    public function getUser($Login, $Password){
        return $this->db->query("SELECT * FROM `user_data` WHERE (`Login` = '$Login' AND `Password` = '$Password') OR (`Email` = '$Login' AND `Password` = '$Password')");
    }

    public function getLogin($Login){
        return $this->db->query("SELECT * FROM `user_data` WHERE `Login` = '$Login'");
    }
    public function getEmail($Email){
        return $this->db->query("SELECT * FROM `user_data` WHERE `Email` = '$Email'");
    }

    public function AddUser($Login, $Password, $Email, $Date){
        $this->db->query("INSERT INTO `user_data` (`Login`, `Password`, `Email`, `Date`) VALUES ('$Login', '$Password', '$Email', '$Date')");
        
    }

    // public function AddUser($Login, $Password, $Email, $Date){
    //     $this->db->query("INSERT INTO `user_data` (`Login`, `Password`, `Email`, `Date`) VALUES ('$Login', '$Password', '$Email', '$Date')");
        
    // }

    // public function getLogin($Login){
    //     return $this->db->query("SELECT * FROM `user_data` WHERE `Login` = '$Login'");
    // }
    // public function getEmail($Email){
    //     return $this->db->query("SELECT * FROM `user_data` WHERE `Email` = '$Email'");
    // }


    // public function getUser($Login, $Password){
    //     return $this->db->query("SELECT * FROM `user_data` WHERE (`Login` = '$Login' AND `Password` = '$Password') OR (`Email` = '$Login' AND `Password` = '$Password')");
    // }

    // public function addSession($Login, $SessionId, $Ip, $Location, $Os, $Date){
    //     $this->db->query("INSERT INTO `session` (`Login`, `SessionId`, `Ip`, `Location`, `Os`, `CreateDate`, `LastActive`) VALUES ('$Login', '$SessionId', '$Ip', '$Location', '$Os', '$Date', '$Date')");
    // }
    // public function removeSession($Login, $Id){
    //     $this->db->query("DELETE FROM `session` WHERE `Login` = '$Login' AND `SessionId` = '$Id'");
    // }
    
}
