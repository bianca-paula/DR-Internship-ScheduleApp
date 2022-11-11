<?php
    include_once('../utils/DBConfiguration.php');
    class ScheduledCourse {
        private int $id;
        private int $room_id;
        private int $course_id;
        private string $from_date;
        private string $until_date;

        function __construct(int $id, int $room_id, int $course_id, string $from_date, string $until_date){
            $this->id = $id;
            $this->room_id = $room_id;
            $this->course_id = $course_id;
            $this->from_date = $from_date;
            $this->until_date = $until_date;
        }

        public function getID(){
            return $this->id;
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
        
    }
?>