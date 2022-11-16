<?php
class CourseHelper{

    private DbConfiguration $db;
    public function __construct(DbConfiguration $db){
        $this->db =$db;
    }

    const COURSE_BY_ID = "SELECT id, name, type FROM Course WHERE id = :course_id;";

    const COURSE_TABLE = "CREATE TABLE IF NOT EXISTS Course(
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        name VARCHAR(25) NOT NULL,
                        type ENUM('Lecture', 'Seminary', 'Laboratory') NOT NULL,
                        UNIQUE KEY (name, type));";

    const COURSE_INSERT_MOCK_DATA = "INSERT IGNORE INTO Course(name, type) values 
                                    ('AI', 'Lecture'), ('AI', 'Seminary'), 
                                    ('AI', 'Laboratory'), ('ASC', 'Lecture'), 
                                    ('ASC', 'Seminary'), ('ASC', 'Laboratory')";
    
    public function getCourseByID(int $course_id){
        $sql = self::COURSE_BY_ID;
        $course_object = $this->db->execute($sql, array('course_id' => $course_id))->fetch();
        $course = new Course($course_object['id'], $course_object['name'], $course_object['type']);
        return $course;
    }
}
?>