<?php
class RoomHelper{
    public static function create_room_table(){
        return "CREATE TABLE IF NOT EXISTS Room(
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(20) NOT NULL UNIQUE,
                capacity INT NOT NULL CHECK(capacity >= 0)
        );";
    }
    
    public static function getRoomQuery(){
        return "SELECT id, name, capacity FROM Room WHERE id = :room_id;";
    }
    
    public static function insert_room_table(){
        return "INSERT IGNORE INTO Room(name, capacity) 
                values('Nicolae Iorga', 200), ('C1', 35), ('C2', 35), ('C3', 15)";
    }
}
?>