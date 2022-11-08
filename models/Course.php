<?php

  include_once('../utils/DBConfiguration.php');
    class Course {

        private string $name;
        private string $type;
        private DbConfiguration $db;

        function __construct(DbConfiguration $db, string $name="", string $type=""){
            $this->db = $db;
            $this->name = $name;
            $this->type = $type;
            $sql_check_table_exists = $this->checkTable();
            $check_if_table = $this->db->connection->query($sql_check_table_exists);
            if(!isset($check_if_table->fetch()['TABLE_NAME'])){
                $this->db->connection->query($this->createCourseTable());
            }   
        }

        public function __set($name, $type) {}
        private function checkTable(){
            return "SELECT table_name FROM information_schema.tables
            where table_name = 'course'
            ;";
        }

        public function getName(){
            return $this->name;
        }
        
        public function setName($name){
            $this->name=$name;
        }

        public function getType(){
            return $this->type;
        }
        
        public function setType($type){
            $this->type=$type;
        }

        public static function insertMockData(){
            return "INSERT IGNORE INTO Course(name, type) values 
            ('AI', 'Lecture'), ('AI', 'Seminary'), 
            ('AI', 'Laboratory'), ('ASC', 'Lecture'), 
            ('ASC', 'Seminary'), ('ASC', 'Laboratory')";
        }

        private function createCourseTable(){
            return "CREATE TABLE IF NOT EXISTS Course(
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    name VARCHAR(25) NOT NULL,
                    type ENUM('Lecture', 'Seminary', 'Laboratory') NOT NULL,
                    UNIQUE KEY (name, type)
            );";
        }
    }
?>