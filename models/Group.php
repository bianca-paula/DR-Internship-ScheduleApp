<?php

include_once('../utils/DbConfiguration.php');

class Group{
    // Properties
    private $id;
    private $name;
    private DbConfiguration $db_config;
    
    // Constructor
    function __construct(DbConfiguration $db, string $name){
            
            $this->db_config = $db;
            $this->name = $name;
            
            $sql_check_table_exists = $this->checkTable();
            $existing_table = $this->db_config->connection->query($sql_check_table_exists);
            
            if(!isset($existing_table->fetch()['TABLE_NAME'])){
                $this->db_config->connection->query($this->createGroupTable());
                $this->db_config->connection->query($this->insertMockData());
            }
            
    }
    
    
    private static function checkTable(){
        return "SELECT table_name FROM information_schema.tables
            where table_name = '`group`'
            ;";
    }
    
    private static function createGroupTable(){
        return "CREATE TABLE IF NOT EXISTS `Group`(
             id INT AUTO_INCREMENT PRIMARY KEY,
             name VARCHAR(10) NOT NULL
            );";
    }
    
    private function insertMockData(){
        $insert_stmt = "INSERT IGNORE INTO `group`(name) VALUES ";
        for($section=1; $section<3; $section++){
        // 2 sections (ro, en)
            for($year=1; $year<4; $year++){
            // 3 years of study
                for($group=1; $group<6; $group++){
                // 5 groups for each year
                    $group_name= "" . $section . $year . $group;
                    $year_group_name = "" . $section . $year . "A";
                    for($course=0; $course<=10; $course++)
                    // Adding groups to be connected to courses
                        $insert_stmt = $insert_stmt . "('" . $year_group_name . "'), ";
                    for($seminary=0; $seminary<=6; $seminary++)
                    // Adding groups to be connected to seminaries
                        $insert_stmt = $insert_stmt . "('" . $group_name . "'), ";
                        for($laboratory=0; $laboratory<=8; $laboratory++)
                        // Adding groups to be connected to laboratories
                        {
                            $insert_stmt = $insert_stmt . "('" . $group_name . "/1'), ";
                            $insert_stmt = $insert_stmt . "('" . $group_name . "/2'), ";
                        }
                }
            }
        }
        
        $insert_stmt = rtrim($insert_stmt, ", ");
        
        return $insert_stmt;
        
    }
    
    
    // Getters and Setters
    function set_id($id) {
        $this->id = $id;
    }
    function get_id() {
        return $this->id;
    }
    function set_name($name) {
        $this->name = $name;
    }
    function get_name() {
        return $this->name;
    }
    
    
}

?>








