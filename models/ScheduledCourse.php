<?php
    include_once('../utils/DBConfiguration.php');
    class ScheduledCourse {
        private int $id;
        private int $room_id;
        private int $course_id;
        private string $from_date;
        private string $until_date;
        private DbConfiguration $db;

        function __construct(DbConfiguration $db, int $room_id, int $course_id, string $from_date, string $until_date){
            $this->db = $db;
            $this->room_id = $room_id;
            $this->course_id = $course_id;
            $this->from_date = $from_date;
            $this->until_date = $until_date;
            $sql_check_table_exists = $this->checkTable();
            $check_if_table = $this->db->connection->query($sql_check_table_exists);
            if(!isset($check_if_table->fetch()['TABLE_NAME'])){
                $this->db->connection->query($this->createScheduledCourseTable()); 
            }
        }

        private function checkTable(){
            return "SELECT table_name FROM information_schema.tables
            where table_name = 'Scheduled_Course'
            ;";
        }

        public function getRoomID(){
            return $this->room_id;
        }
        
        public function setRoomID($room_id){
            $this->room_id = $room_id;
        }

        public function getCourseID(){
            return $this->course_id;
        }
        
        public function setCourseID($course_id){
            $this->course_id = $course_id;
        }

        public function getFromDate(){
            return $this->from_date;
        }
        
        public function setFromDate($from_date){
            $this->from_date = $from_date;
        }

        public function getUntilDate(){
            return $this->until_date;
        }
        
        public function setUntilDate($until_date){
            $this->until_date = $until_date;
        }
        
        public static function insertMockData(){
            return "INSERT IGNORE INTO Scheduled_Course(room_id, course_id, from_date, until_date) values 
            (1, 1, '2022-10-27 10:00:00', '2022-10-27 12:00:00'), 
            (2, 2, '2022-10-28 14:00:00', '2022-10-28 16:00:00'), 
            (4, 3, '2022-10-28 18:00:00', '2022-10-28 20:00:00')";
        }

        private function createScheduledCourseTable(){
            return "CREATE TABLE IF NOT EXISTS Scheduled_Course(
                id INT AUTO_INCREMENT PRIMARY KEY,
                room_id INT NOT NULL,
                course_id INT NOT NULL,
                from_date DATETIME NOT NULL,
                until_date DATETIME NOT NULL,
                FOREIGN KEY (course_id) REFERENCES course(id),
                FOREIGN KEY (room_id) REFERENCES room(id)
            );";
        }
    }
?>