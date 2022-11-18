<?php

class RoleHelper{
    static function insertRole($db,$roleName)
    {
        $get_role = "SELECT name FROM Role WHERE name = '$roleName'";
        $role_exists = $db->execute($get_role);
        if (!$role_exists) {
            $sql = "INSERT INTO role (name) VALUES ('$roleName')";
            return $db->execute($sql);
        }
    }

    const ROLE_TABLE = "CREATE TABLE IF NOT EXISTS Role (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(10) NOT NULL UNIQUE
        )";

    const ROLE_TABLE_MOCK_DATA = "INSERT INTO Role (name) VALUES
                                ('Professor'),
                                ('Student'),
                                ('Admin');";

    static function createStructure($db)
    {
        $db->execute(self::ROLE_TABLE);
    }

    static function insertData($db)
    {
        $db->execute(self::ROLE_TABLE_MOCK_DATA);
    }
}
