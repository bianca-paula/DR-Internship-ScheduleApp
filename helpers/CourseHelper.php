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
                                    ('ASC', 'Seminary'), ('ASC', 'Laboratory'),
                                    ('II', 'Lecture'), ('II', 'Laboratory')";
    
    const COURSES_FROM_PROF = "SELECT course_id FROM groupuser INNER JOIN groupcourse ON groupuser.group_id = groupcourse.group_id WHERE groupuser.user_id = :prof_id";

    const COURSE_NAME_TYPE = "SELECT name, type FROM course WHERE id = :course_id";
    
    public function getCoursesForProf($prof_id) {
        $result = array();
        $sql = self::COURSES_FROM_PROF;
        $courses_array = $this->db->execute($sql, array('prof_id' => $prof_id))->fetchAll();
        
        foreach($courses_array as $course) {
            array_push($result, $this->getNameType($course['course_id']));        
        }
        return $result;
    }

    public function getCourseByID(int $course_id){
        $sql = self::COURSE_BY_ID;
        $course_object = $this->db->execute($sql, array('course_id' => $course_id))->fetch();
        $course = new Course($course_object['id'], $course_object['name'], $course_object['type']);
        return $course;
    }

    public function getNameType($course_id) {
        $sql = self::COURSE_NAME_TYPE;
        $course_object = $this->db->execute($sql, array('course_id' => $course_id))->fetch();
        return $course_object['name'] . " - " . $course_object['type'];
    }

    public static function createStructure($db) {
        // var_dump($db); die();
        $db->execute(self::COURSE_TABLE);
    }

    public static function insertData($db) {
        $db->execute(self::COURSE_INSERT_MOCK_DATA);
    }
}
?>