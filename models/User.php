<?php
<<<<<<< Updated upstream
include_once('../../utils/DBConfiguration.php');
=======
include_once('../utils/DbConfiguration.php');
>>>>>>> Stashed changes


class User {
    // Properties
    private $id;
    private $email;
    private $password;
    private $first_name;
    private $last_name;
    private $prefix;
    private DbConfiguration $db_config;
    
    // Constructor
    function __construct(DbConfiguration $db, string $email,
<<<<<<< Updated upstream
        string $password, string $first_name, string $last_name, string $prefix){
=======
        string $password, string $first_name, string $last_name, ?string $prefix){
>>>>>>> Stashed changes
        
        $this->db_config = $db;
        $this->email = $email;
        $this->password = $password;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->prefix = $prefix;
        
        
        $sql_check_table_exists = $this->checkTable();
        $existing_table = $this->db_config->connection->query($sql_check_table_exists);
        
        if(!isset($existing_table->fetch()['TABLE_NAME'])){
            $this->db_config->connection->query($this->createUserTable());
<<<<<<< Updated upstream
            
            $this->db_config->connection->query($this->insertMockData());
            //echo $this->insertMockData();
=======
            $this->db_config->connection->query($this->insertMockData());
>>>>>>> Stashed changes
        } 
        
    }
    
    private static function checkTable(){
        return "SELECT table_name FROM information_schema.tables
            where table_name = 'user'
            ;";
    }
    
    private static function createUserTable(){
        return "CREATE TABLE IF NOT EXISTS User(
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    email VARCHAR(20) NOT NULL UNIQUE,
<<<<<<< Updated upstream
                    password VARCHAR(20) NOT NULL,
=======
                    password VARCHAR(100) NOT NULL,
>>>>>>> Stashed changes
                    first_name VARCHAR(30) NOT NULL,
                    last_name VARCHAR(20) NOT NULL,
                    prefix VARCHAR(10)
            );";
    }
<<<<<<< Updated upstream
    
    
    
=======

>>>>>>> Stashed changes
    private function insertMockData(){
        $sql__insert_stmt = "INSERT IGNORE INTO User(email, password, first_name, last_name, prefix) values ";
        
        // Adding Student accounts
<<<<<<< Updated upstream
        for($ind=1; $ind<=200; $ind++){ 
=======
        for($ind=1; $ind<=600; $ind++){ 
>>>>>>> Stashed changes
            $email = "student" . $ind . "@studmail.com";
            $password = md5($this->createRandomPassword());
            $first_name = "First" . $ind;
            $last_name = "Last" . $ind;
            
            $sql__insert_stmt = $sql__insert_stmt . "('" . $email . "', '" . $password . "', '" . $first_name . "', '" . $last_name . "', ''), ";
        }
        
 
        // Adding Teacher Accounts
        for($ind=1; $ind<=30; $ind++){
            $email = "professor" . $ind . "@studmail.com";
            $password = md5($this->createRandomPassword());
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
        $password = md5($this->createRandomPassword());
<<<<<<< Updated upstream
        $sql__insert_stmt = $sql__insert_stmt .  "('admin@studmail.com', '" . $password . "', 'FN', 'LN', '');";
        
       
        
        return $sql__insert_stmt;
    }
    
    
=======
        $sql__insert_stmt = $sql__insert_stmt .  "('admin@studmail.com', '" . $password . "', 'FN', 'LN', '')";
        
        
        return $sql__insert_stmt; 
        
    }
    
>>>>>>> Stashed changes
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
    
    
<<<<<<< Updated upstream
    
=======
    function verifyUser($email, $password){
        // Checks that the credentials are valid
        // Returns the user if it can be found
        
        $query = "SELECT * FROM `user` WHERE 
        `user`.email = '" . $email . "' AND 
        `user`.`password` = '" . md5($password) . "';";
        
        $user = $this->db_config->connection->query($query);
        $found = $user->fetch();
        if (isset($found['email'])){
            $result = new User($this->db_config, $found['email'], $found['password'],
                $found['first_name'], $found['last_name'], $found['prefix']);
            $result->set_id($found['id']);
            return $result;
        }
        
        return null;
        
    }
   
>>>>>>> Stashed changes
    
    // Getters and Setters
    function set_id($id) {
        $this->id = $id;
    }
    function get_id() {
        return $this->id;
    }
    function get_email() {
        return $this->email;
    }
    function set_email($email) {
        $this->email = $email;
    }
    function set_password($password) {
        $this->password = $password;
    }
    function get_password() {
        return $this->password;
    }
    function set_first_name($first_name) {
        $this->first_name = $first_name;
    }
    function get_first_name() {
        return $this->first_name;
    }
    function set_last_name($last_name) {
        $this->last_name = $last_name;
    }
    function get_last_name() {
        return $this->last_name;
    }
    function set_prefix($prefix) {
        $this->prefix = $prefix;
    }
    function get_prefix() {
        return $this->prefix;
    }

<<<<<<< Updated upstream
 
    // Other Methods
=======
>>>>>>> Stashed changes
    

}


?>