<?php
class RoomHelper{

    private DbConfiguration $db;

    public function __construct(DbConfiguration $db){
        $this->db =$db;
    }

    const ROOM_BY_ID = "SELECT id, name, capacity 
                        FROM Room WHERE id = :room_id;";

    const ROOM_TABLE = "CREATE TABLE IF NOT EXISTS Room(
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        name VARCHAR(20) NOT NULL UNIQUE,
                        capacity INT NOT NULL CHECK(capacity >= 0));";

    const ROOM_INSERT_MOCK_DATA = "INSERT IGNORE INTO Room(name, capacity) values
                                ('Nicolae Iorga', 200), 
                                ('C1', 35), 
                                ('C2', 15), 
                                ('C3', 15)";

    const ROOM_NAME = "SELECT name FROM room WHERE id = :room_id";

    public function getRoomForProf($room_id){
        $result = array();
        $sql = self::ROOM_NAME;
        $rooms_array = $this->db->execute($sql, array('room_id' => $room_id))->fetchAll();
        $room_object = $this->db->execute($sql, array('room_id' => $room_id))->fetch();
        
        foreach($rooms_array as $room) {
            array_push($result, $room_object['name']);        
        }
        return $result;
    }

    public function getRoomByID(int $room_id){
        $sql = self::ROOM_BY_ID;
        $room_object = $this->db->execute($sql, array('room_id' => $room_id))->fetch();
        $room = new Room($room_object['id'], $room_object['name'], $room_object['capacity']);
        return $room;
    }

    public static function createStructure($db) {
        $db->execute(self::ROOM_TABLE);
    }

    public static function insertData($db) {
        $db->execute(self::ROOM_INSERT_MOCK_DATA);
    }
    
}
?>