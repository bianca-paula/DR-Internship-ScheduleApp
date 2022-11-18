<?php

class CourseHelper
{
    private DbConfiguration $db;
    public function __construct(DbConfiguration $db)
    {
        $this->db = $db;
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

    const GET_ALL_COURSE = "SELECT id, name as course_name, type
                            FROM Course";

    const ADD_COURSE = "INSERT INTO Course (name, type) VALUES (:course_name, :course_type)";

    public function getCourseByID(int $course_id)
    {
        if($course_id){
            $sql = self::COURSE_BY_ID;
            $course_object = $this->db->execute($sql, array('course_id' => $course_id))->fetch();
            $course = new Course($course_object['id'], $course_object['name'], $course_object['type']);
            return $course;
        }
    }

    public function deleteCourse($course_id)
    {
        if ($course_id) {
            $sql = "DELETE FROM Course WHERE id = :course_id";
            return $this->db->execute($sql, array('course_id' => $course_id))->fetch();
        }
    }

    public function addCourse($course_name, $course_type)
    {
        if ($course_name && $course_type) {
            $sql = self::ADD_COURSE;
            return $this->db->execute($sql, array(
                'course_name' => $course_name,
                'course_type' => $course_type
            ));
        }
    }
    public function getAllCourses()
    {
        $sql = self::GET_ALL_COURSE;
        $courses_arr = $this->db->execute($sql)->fetchAll();
        $courses = [];

        //curse object
        foreach ($courses_arr as $course) {
            $courses[] = new Course($course['id'], $course['course_name'], $course['type']);
        }
        // echo $courses;
        return $courses;
    }

    static function createStructure($db)
    {
        $db->execute(self::COURSE_TABLE);
    }

    static function insertData($db)
    {
        $db->execute(self::COURSE_INSERT_MOCK_DATA);
    }
}
