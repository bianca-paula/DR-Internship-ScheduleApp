<?php
    include_once('../utils/DBConfiguration.php');
    class CourseAttendance {

        private int $user_id;
        private int $scheduled_course_id;
        private DbConfiguration $db;

        function __construct(DbConfiguration $db, int $user_id, int $scheduled_course_id){
            $this->db = $db;
            $this->user_id = $user_id;
            $this->scheduled_course_id = $scheduled_course_id;
            $sql_check_table_exists = $this->checkTable();
            $check_if_table = $this->db->connection->query($sql_check_table_exists);
            if(!isset($check_if_table->fetch()['TABLE_NAME'])){
                $this->db->connection->query($this->createCourseAttendanceTable()); 
            }   
        }

        private function checkTable(){
            return "SELECT table_name FROM information_schema.tables
            where table_name = 'CourseAttendance'
            ;";
        }

        public function getUserID(){
            return $this->user_id;
        }
        
        public function setUserID($user_id){
            $this->user_id=$user_id;
        }

        public function getScheduledCourseID(){
            return $this->scheduled_course_id;
        }
        
        public function setScheduledCourseID($scheduled_course_id){
            $this->scheduled_course_id=$scheduled_course_id;
        }

        public static function insertMockData(){
            return "INSERT IGNORE INTO Course_Attendance(user_id, scheduled_course_id) values 
            (2, 1), 
            (3, 1), 
            (3, 2), 
            (3, 3)";
        }

        private function createCourseAttendanceTable(){
            return "CREATE TABLE IF NOT EXISTS Course_Attendance(
                user_id INT,
                scheduled_course_id INT,
                PRIMARY KEY(user_id, scheduled_course_id)
        );";
        }
    }
?>