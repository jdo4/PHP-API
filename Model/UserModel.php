<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";
class UserModel extends Database
{
    /* Gets the users from the DB tables*/
    public function getUsers($limit)
    {
        echo("limit = " . $limit);
        return $this->select("SELECT * FROM users ORDER BY user_id ASC LIMIT ?", ["i", $limit]);
    }
}