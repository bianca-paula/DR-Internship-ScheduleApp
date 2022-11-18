<?php

include_once "./models/User.php";

class UserHelper{
    
    private DbConfiguration $db;

    public function __construct(DbConfiguration $db){
        $this->db = $db;
    }


    const CHECK_TABLE_QUERY = "SELECT table_name FROM information_schema.tables
                                WHERE table_name = 'user';";

    const CREATE_USER_TABLE_STMT = "CREATE TABLE IF NOT EXISTS User(
                                    id INT AUTO_INCREMENT PRIMARY KEY,
                                    email VARCHAR(30) NOT NULL UNIQUE,
                                    password VARCHAR(50) NOT NULL,
                                    first_name VARCHAR(30) NOT NULL,
                                    last_name VARCHAR(20) NOT NULL,
                                    prefix VARCHAR(10)
                                    );";

    const FIND_USER_BY_CREDENTIALS_QUERY = "SELECT * FROM `user` WHERE
                                            `user`.email = ':user_email' AND
                                            `user`.`password` = ':user_password';";

    const GET_USER_ROLE_QUERY = "SELECT role.name FROM role INNER JOIN userrole
    ON role.id = userrole.role_id WHERE userrole.user_id = :user_id";

    function setUpUserTable () {
        

        $table_exists = $this->db->execute(self::CHECK_TABLE_QUERY)->fetch();
        
        if($table_exists == false){
            $this->db->execute(self::CREATE_USER_TABLE_STMT);
            $this->db->execute(self::insertUsersStatement());
        }
        
    }
    
    
    private function insertUsersStatement(){
        $sql__insert_stmt = "INSERT IGNORE INTO User(email, password, first_name, last_name, prefix) values ";
        
        // Adding Student accounts
        for($ind=1; $ind<=600; $ind++){
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
        $sql__insert_stmt = $sql__insert_stmt .  "('admin@studmail.com', '" . $password . "', 'ADMIN_FN', 'ADMIN_LN', '')";
        
        return $sql__insert_stmt;
    }
    
    
    private function createRandomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
    
    function verifyUser(string $email, string $password){
        // Checks that the credentials are valid
        // Returns the user if it can be found
        $query = "SELECT * FROM `user` WHERE
        `user`.email = '" . $email . "' AND
        `user`.`password` = '" . md5($password) . "';";
        $response = $this->db->execute($query)->fetch();
        if ($response != false){
            $result = new User($response['id'], $response['email'], $response['password'],
                    $response['first_name'], $response['last_name'], $response['prefix']);
            return $result;
        }
        
        return null;
    }
    
    function getUserRole($user_id){
        $response = $this->db->execute(self::GET_USER_ROLE_QUERY,
        array('user_id'=>$user_id))->fetch();
        
        if ($response != false){
            return $response['name'];
        }
        
        return null;
    }
    
    
}

?>