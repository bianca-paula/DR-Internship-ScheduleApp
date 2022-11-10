<?php

include_once './config/DBConfiguration.php';

class Room {
    private $roomName;
    private $roomCapacity;
    private DBConfiguration $db_config;

    function __construct(DBConfiguration $db, $name, $capacity) {
        $this->db_config = $db;
        $this->roomName = $name;
        $this->roomCapacity = $capacity;

        $room_table = $this->db_config->connection->query($this->checkRoomTable());

        if(!isset($room_table->fetch()['TABLE_NAME'])) {
            $this->db_config->connection->query($this->createRoomTable());
        }
    }

    private function checkRoomTable() {
        return "SELECT table_name FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = 'Room' ";
    }

    private function createRoomTable() {
        return "CREATE TABLE IF NOT EXISTS Room(
            roomName VARCHAR(20) NOT NULL UNIQUE, 
            roomCapacity INT NOT NULL CHECK(roomCapacity >= 0)
            )";
    }
};

?>

