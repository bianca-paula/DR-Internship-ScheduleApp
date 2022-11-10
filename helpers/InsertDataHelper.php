<?php

class InsertDataHelper{
    static function insertRole($db,$roleName)
    {
        $get_role = "SELECT name FROM Role WHERE name = '$roleName'";
        $role_exists = $db->execute($get_role);
        var_dump($role_exists);
        if (!$role_exists) {
            $sql = "INSERT INTO role (name) VALUES ('$roleName')";
            return $db->execute($sql);
        }
    }
}

?>