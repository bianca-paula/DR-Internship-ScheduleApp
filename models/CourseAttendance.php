<?php
    class CourseAttendance {
        private int $id;
        private int $user_id;
        private int $scheduled_course_id;

        function __construct(int $id, int $user_id, int $scheduled_course_id){
            $this->id = $id;
            $this->user_id = $user_id;
            $this->scheduled_course_id = $scheduled_course_id;   
        }

        public function getID(){
            return $this->id;
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

    }
?>