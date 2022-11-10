<?php

include_once $_SERVER['DOCUMENT_ROOT'].'../utils/DBConfig.php';

class Role{

    // private $id;
    // private $name;
    private DBConfig $db_config;

    function __construct(DBConfig $db){
        // $this->id = $id;
        // $this->name = $name;
        $this->db_config = $db;
        // echo $this->db_config->getConnection();

        $role_table = $this->db_config->getConnection()->query($this->checktable());
    
        if(!isset($role_table->fetch()['TABLE_NAME'])){
            $this->db_config->getConnection()->query($this->createRoleTable());
        }
    }

    // public function getConnection()
    // {
    //     return $this->db_config;
    // }

    private function checktable(){
        return "SELECT table_name 
        FROM INFORMATION_SCHEMA.TABLES 
        WHERE TABLE_NAME = 'Role'
        ";
    }

    private function createRoleTable(){
        return "CREATE TABLE IF NOT EXISTS Role (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(10) NOT NULL UNIQUE
        )";
    }
}
