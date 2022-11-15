<?php
class DBHelper{
    
    public static function checkTable($table_name){
        return "SELECT table_name FROM information_schema.tables
                WHERE table_name = $table_name;";
    }

    public static function checkDatabase($database_name){
        return "SELECT SCHEMA_NAME
                FROM INFORMATION_SCHEMA.SCHEMATA
                WHERE SCHEMA_NAME = '$database_name';";
    }

    public static function createDatabase($database_name){
        return "CREATE DATABASE $database_name";
    }

}
?>