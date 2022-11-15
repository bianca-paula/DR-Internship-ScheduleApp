<?php
class DBHelper{

    // const CHECK_TABLE = "SELECT table_name FROM information_schema.tables
    //                     WHERE table_name = :table_name;";

    // const CHECK_DATABASE = "SELECT SCHEMA_NAME
    //                         FROM INFORMATION_SCHEMA.SCHEMATA
    //                         WHERE SCHEMA_NAME = :database_name;";

    // const CREATE_DATABASE = "CREATE DATABASE :database_name";

    public static function checkTable(){
        return "SELECT table_name FROM information_schema.tables
                WHERE table_name = :table_name;";
    }
    public static function checkDatabase(){
        return "SELECT SCHEMA_NAME
                FROM INFORMATION_SCHEMA.SCHEMATA
                WHERE SCHEMA_NAME = :database_name;";
    }
    public static function createDatabase(){
        return "CREATE DATABASE :database_name";
    }
}
?>