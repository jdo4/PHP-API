<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";
class UserModel extends Database
{
    /* Gets the users from the DB tables*/
    public function getUsers($limit)
    {
        return $this->select("SELECT * FROM user ORDER BY user_id ASC LIMIT ?", ["i", $limit]);
    }

    /* Gets the product from the DB tables*/
    public function getProducts($limit)
    {   
        return $this->select("SELECT * FROM Product LIMIT ?", ["i", $limit]);
    }

    /* Gets the Comments from the DB tables for perticuler product*/
    public function getCommets($userid,$productid)
    {   
        return $this->select("SELECT * FROM Comments WHERE user_id = '$userid' AND product_id = '$productid'");
    }

    /* Post the Comments from the DB tables for perticuler product*/
    public function postComment($pid,$uid,$rating,$img,$txt)
    {     
                return $this->signup("INSERT INTO `Comments` (`product_id`, `user_id`, `rating`, `images`, `text`) VALUES ('$pid', '$uid', '$rating', '$img', '$txt')");
    }

    public function deleteComment($pid,$uid)
    {     
                return $this->select("DELETE FROM `Comments` WHERE user_id = $uid AND product_id = $pid");
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