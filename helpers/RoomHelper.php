<?php
function create_room_table(){
    return "CREATE TABLE IF NOT EXISTS Room(
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(20) NOT NULL UNIQUE,
            capacity INT NOT NULL CHECK(capacity >= 0)
    );";
}

function getRoomQuery(int $roomID){
    return "SELECT *
            FROM Room
            WHERE id = $roomID;";
}

function insert_room_table(){
    return "INSERT IGNORE INTO Room(name, capacity) values('Nicolae Iorga', 200), ('C1', 35), ('C2', 35), ('C3', 15)";
}
?>