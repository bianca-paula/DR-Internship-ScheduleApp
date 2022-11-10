<?php

include_once "../models/Group.php";

class GroupHelper{
    
    static function setUpUserTable (DbConfiguration $db_config) {
        
        $table_exists = $db_config->execute(self::checkTableQuery());
        
        if($table_exists == false){
            $db_config->execute(self::createGroupTableStatement());
            $db_config->execute(self::insertGroupsStatement());
        }
    }
    
    private static function checkTableQuery(){
        return "SELECT table_name FROM information_schema.tables
            where table_name = '`group`'
            ;";
    }
    
    
    private static function createGroupTableStatement(){
        return "CREATE TABLE IF NOT EXISTS `Group`(
             id INT AUTO_INCREMENT PRIMARY KEY,
             name VARCHAR(10) NOT NULL
            );";
    }
    
    
    private static function insertGroupsStatement(){
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
    
}

?>