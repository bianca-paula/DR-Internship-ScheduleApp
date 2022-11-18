<?php

include_once('../utils/DBConfig.php');

class UserRoles
{

    private $user_id;
    private $role_id;


    function __construct($user_id, $role_id)
    {
        $this->user_id = $user_id;
        $this->role_id = $role_id;
    }

    public function getUserID()
    {
        return $this->user_id;
    }

    public function getRoleID()
    {
        return $this->role_id;
    }
};
