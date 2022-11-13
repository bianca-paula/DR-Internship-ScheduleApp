<?php
class CourseHelper{

    public static function createCourseTable(){
        return "CREATE TABLE IF NOT EXISTS Course(
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(25) NOT NULL,
                type ENUM('Lecture', 'Seminary', 'Laboratory') NOT NULL,
                UNIQUE KEY (name, type)
        );";
    }

    public static function getCourseQuery(){
        return "SELECT id, name, type FROM Course WHERE id = :course_id;";
    }

    public static function insertMockDataCourse(){
        return "INSERT IGNORE INTO Course(name, type) values 
                ('AI', 'Lecture'), ('AI', 'Seminary'), 
                ('AI', 'Laboratory'), ('ASC', 'Lecture'), 
                ('ASC', 'Seminary'), ('ASC', 'Laboratory')";
    }
}
?>