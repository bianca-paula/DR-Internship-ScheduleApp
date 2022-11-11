<?php
class CourseAttendanceHelper{

    public static function createCourseAttendanceTable(){
        return "CREATE TABLE IF NOT EXISTS Course_Attendance(
            user_id INT,
            scheduled_course_id INT,
            PRIMARY KEY(user_id, scheduled_course_id)
        );";
    }

    public static function insertMockData(){
            return "INSERT IGNORE INTO Course_Attendance(user_id, scheduled_course_id) 
                    values (2, 1), (3, 1), (3, 2), (3, 3)";
    }
}
?>