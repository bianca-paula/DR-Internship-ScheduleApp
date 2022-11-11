<?php
class DBHelper{
    
    public static function checkTable($table_name){
        return "SELECT table_name FROM information_schema.tables
                WHERE table_name = $table_name;";
    }
}
?>