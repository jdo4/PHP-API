<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";
class UserModel extends Database
{
    /* Gets the users from the DB tables*/
    public function getUsers($limit)
    {
         
        return $this->select("SELECT * FROM user ORDER BY user_id ASC LIMIT ?", ["i", $limit]);
        
    }

    public function signupUsers($username,$email,$pass)
    {
                $history = '';
                $shipping_address = '';
                 
                return $this->signup("INSERT INTO `user` (`username`, `email`, `password`, `history`, `shipping_address`) VALUES ('$username', '$email','$pass','', '')");
        
    }

    public function loginUser($username,$pass)
    {
                // echo 'username :' . $username;
                //echo 'password :' . $pass;
                return $this->login("SELECT * FROM `user` WHERE username = '$username' AND password='$pass'");
        
    }
}