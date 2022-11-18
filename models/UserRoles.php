<?php

class UserRoles{

    private $user_id;
    private $role_id;

    private DBConfig $db_config;

    function __construct(DBConfig $db, $user_id, $role_id){
        $this->db_config = $db;
        $this->user_id = $user_id;
        $this->role_id = $role_id;

        $user_role_table = $this->db_config->connection->query($this->checktable());
    
        if(!isset($user_role_table->fetch()['TABLE_NAME'])){
            $this->db_config->connection->query($this->createUserRoleTable());
        }
    }


    private function checktable()
    {
        return "SELECT table_name 
        FROM INFORMATION_SCHEMA.TABLES 
        WHERE TABLE_NAME = 'UserRoles'
        ";
    }

    private function createUserRoleTable(){
        return "CREATE TABLE IF NOT EXISTS UserRoles(
            user_id INT NOT NULL,
            role_id INT NOT NULL,
            CONSTRAINT fk_UserRoles_User foreign key (user_id) references User(id),
            CONSTRAINT fk_UserRoles_Role foreign key (role_id) references Role(id),
            CONSTRAINT pk_id PRIMARY KEY (user_id, role_id)
        )";
    }

};
