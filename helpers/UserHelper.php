<?php

class UserHelper{
    
    static function setUpUserTable (DbConfiguration $db_config) {
        
        $table_exists = $db_config->execute(self::checkTableQuery());
        
        if($table_exists == false){
            $db_config->execute(self::createUserTableQuery());
            $db_config->execute(self::insertUsersStatement());
        }
        
    }

    
    private static function checkTableQuery(){
        return "SELECT table_name FROM information_schema.tables
            where table_name = 'user'
            ;";
    }
    
    
    private static function createUserTableQuery(){
        return "CREATE TABLE IF NOT EXISTS User(
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    email VARCHAR(30) NOT NULL UNIQUE,
                    password VARCHAR(50) NOT NULL,
                    first_name VARCHAR(30) NOT NULL,
                    last_name VARCHAR(20) NOT NULL,
                    prefix VARCHAR(10)
            );";
    }
    
    
    private static function insertUsersStatement(){
        $sql__insert_stmt = "INSERT IGNORE INTO User(email, password, first_name, last_name, prefix) values ";
        
        // Adding Student accounts
        for($ind=1; $ind<=600; $ind++){
            $email = "student" . $ind . "@studmail.com";
            $password = md5(self::createRandomPassword());
            $first_name = "First" . $ind;
            $last_name = "Last" . $ind;
            
            $sql__insert_stmt = $sql__insert_stmt . "('" . $email . "', '" . $password . "', '" . $first_name . "', '" . $last_name . "', ''), ";
        }
        
        
        // Adding Teacher Accounts
        for($ind=1; $ind<=30; $ind++){
            $email = "professor" . $ind . "@studmail.com";
            $password = md5(self::createRandomPassword());
            $first_name = "PFirst" . $ind;
            $last_name = "PLast" . $ind;
            $prefix = "";
            if($ind<20)
                $prefix = "dr";
                else
                    $prefix = "drd.";
                    
                    $sql__insert_stmt = $sql__insert_stmt . "('" . $email . "', '" . $password . "', '" . $first_name . "', '" . $last_name . "', '" . $prefix . "'), ";
        }
        
        
        // Adding Admin Account
        $password = md5(self::createRandomPassword());
        $sql__insert_stmt = $sql__insert_stmt .  "('admin@studmail.com', '" . $password . "', 'ADMIN_FN', 'ADMIN_LN', '')";
        
        
        return $sql__insert_stmt;
        
        /* Adding some test accounts
         return $sql__insert_stmt . "('test_admin@studmail.com' , '" . md5('test') . "', 'FNAT', 'LNAT', ''),
         ('test_professor@studmail.com' , '" . md5('test') . "', 'FNPT', 'LNPT', 'drd.'),
         ('test_student@studmail.com' , '" . md5('test') . "', 'FNST', 'LNST', '');";
         */
        
    }
    
    
    private static function createRandomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
    
    static function verifyUser(DbConfiguration $db_config, string $email, string $password){
        // Checks that the credentials are valid
        // Returns the user if it can be found
        
        $query = "SELECT * FROM `user` WHERE
        `user`.email = '" . $email . "' AND
        `user`.`password` = '" . md5($password) . "';";
        
        $response = $db_config->execute($query);
        if ($response != false){
            foreach($response as $user){
                // will stop  at first and only user found
                $result = new User($user->email, $user -> password,
                    $user->first_name, $user->last_name, $user->prefix);
                $result->set_id($user->id);
                return $result;
            }
        }
        
        return null;
    }
    
    
    
    static function getUserRole(DbConfiguration $db_config, $user_id){
        $query = "SELECT role.name FROM role INNER JOIN userrole
        ON role.id = userrole.role_id WHERE userrole.user_id = " . $user_id;
        
        $response = $db_config->execute($query);
        
        if ($response != false){
            foreach($response as $role){
                // will stop  at first and only role found
                return $role->name;
            }
        }
        
        return null;
        
    }
    
    
}

?>