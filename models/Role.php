<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '../utils/DBConfig.php';

class Role
{

    private $id;
    private $name;
    private DBConfig $db;

    function __construct(DBConfig $db)
    {
        $this->db = $db;

        $role_table = $this->db->execute($this->checktable());
        if (!$role_table) {
            $this->db->execute($this->createRoleTable());
        }
    }

    private function checktable()
    {
        return "SELECT table_name 
        FROM INFORMATION_SCHEMA.TABLES 
        WHERE TABLE_NAME = 'Role'
        ";
    }

    private function createRoleTable()
    {
        return "CREATE TABLE IF NOT EXISTS Role (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(10) NOT NULL UNIQUE
        )";
    }
}
