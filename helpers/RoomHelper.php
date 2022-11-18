<?php
class RoomHelper{

    const ROOM_BY_ID = "SELECT id, name, capacity 
                        FROM Room WHERE id = :room_id;";

    const ROOM_TABLE = "CREATE TABLE IF NOT EXISTS Room(
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        name VARCHAR(20) NOT NULL UNIQUE,
                        capacity INT NOT NULL CHECK(capacity >= 0));";

    const ROOM_INSERT_MOCK_DATA = "INSERT IGNORE INTO Room(name, capacity) values
                                ('Nicolae Iorga', 200), 
                                ('C1', 35), 
                                ('C2', 35), 
                                ('C3', 15)";
    
}
?>