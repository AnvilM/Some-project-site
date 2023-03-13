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

    public function getEmailFromLogin($Login){
        return $this->db->query("SELECT * FROM `user_data` WHERE `Login` = '$Login' OR `Email` = '$Login'");
    }

    public function updatePasswordFromEmail($Password, $Email){
        return $this->db->query("UPDATE `user_data` SET `Password` = '$Password' WHERE `Email` = '$Email'");
    }
    public function AddUser($Login, $Password, $Email, $Date){
        $this->db->query("INSERT INTO `user_data` (`Login`, `Password`, `Email`, `Date`) VALUES ('$Login', '$Password', '$Email', '$Date')");
        
    }

    public function addSession($Login, $SessionId, $Ip, $Location, $Os, $Browser,  $Date){
        $this->db->query("INSERT INTO `session` (`Login`, `SessionId`, `Ip`, `Location`, `Os`, `Browser`, `CreateDate`, `LastActive`) VALUES ('$Login', '$SessionId', '$Ip', '$Location', '$Os', '$Browser', '$Date', '$Date')");
    }
    public function getSession($Login, $SessionId){
        $arr[0] =  $this->db->query("SELECT * FROM `session` WHERE `Login` = '$Login' AND `SessionId` != '$SessionId'");
        $arr[1] =  $this->db->query("SELECT * FROM `session` WHERE `Login` = '$Login' AND `SessionId` = '$SessionId'");
        return $arr;
    }

    public function delSession($Login, $SessionId){
        return $this->db->query("DELETE FROM `session` WHERE `Login` = '$Login' AND `SessionId` = '$SessionId'");
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
