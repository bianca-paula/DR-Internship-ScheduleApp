<?php

class ScheduledCourseHelper{
    
    public static function createScheduledCourseTable(){
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
    
    public static function getScheduledCoursesQuery(){
        return "SELECT id, room_id, course_id, from_date, until_date FROM Scheduled_Course;";
    }
    
    public static function getScheduledCourseQuery(int $scheduled_course_ID){
        return "SELECT id, room_id, course_id, from_date, until_date 
                FROM Scheduled_Course WHERE id = $scheduled_course_ID;";
    }
    
    public static function insertMockDataScheduledCourse(){
        return "INSERT IGNORE INTO Scheduled_Course(room_id, course_id, from_date, until_date) values 
                (1, 1, '2022-10-27 10:00:00', '2022-10-27 12:00:00'), 
                (2, 2, '2022-10-28 14:00:00', '2022-10-28 16:00:00'), 
                (4, 3, '2022-10-28 18:00:00', '2022-10-28 20:00:00')";
    }
}
?>