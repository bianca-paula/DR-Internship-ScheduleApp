<?php

include_once ('../utils/DBConfig.php');

class Role{

    // private $id;
    // private $name;
    private DBConfig $db_config;

    function __construct(DbConfig $db){
        // $this->id = $id;
        // $this->name = $name;
        $this->db_config = $db;

        $role_table = $this->db_config->connection->query($this->checktable());
    
        if(!isset($role_table->fetch()['TABLE_NAME'])){
            $this->db_config->connection->query($this->createRoleTable());
        }
    }

    private function checktable(){
        return "SELECT table_name 
        FROM INFORMATION_SCHEMA.TABLES 
        WHERE TABLE_NAME = 'Role'
        ";
    }

    private function createRoleTable(){
        return "CREATE TABLE IF NOT EXISTS Role(
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(10) NOT NULL,
        )";
    }
}
