<?php
include_once '../utils/DBConfiguration.php';

include_once '../models/Course.php';
include_once '../helpers/CourseHelper.php';
include_once '../helpers/ScheduledCourseHelper.php';

class ScheduledCourseController{

    private DbConfiguration $db;
    public function __construct(DbConfiguration $db){
        $this->db=$db;
    }
    public function getCourseById(int $course_id){
        $sql="SELECT *
        FROM Course
        WHERE id = $course_id;";
        $statement = $this->db->connection->query($sql);
        $statement->setFetchMode(PDO::FETCH_OBJ);
        $courseObj = $statement->fetch();
        $course = new Course($courseObj->id, $courseObj->name, $courseObj->type);
        return $course;
    }

    public function getScheduledCourses(){
        $sql = "SELECT *
            FROM Scheduled_Course;";
        $statement = $this->db->connection->query($sql);
        $scheduled_courses_array = $statement->fetchAll(PDO::FETCH_OBJ);
        $scheduled_courses = $this->convertToScheduledCourses($scheduled_courses_array);
        return $scheduled_courses;
    }

    public function getScheduledCourseById(int $id){
        $sql = ScheduledCourseHelper::getScheduledCourseQuery($id);
        $statement = $this->db->connection->query($sql);
        $statement->setFetchMode(PDO::FETCH_OBJ);
        $scheduled_course = $statement->fetch();
        $scheduled_courseObj = $this->convertToScheduledCourses($scheduled_course);
        return $scheduled_courseObj;
    }

    public function convertToScheduledCourses($scheduled_courses){
        $courses = [];
        foreach($scheduled_courses as $course){
            $courses[] =new ScheduledCourse($course->id, $course->room_id, $course->course_id, $course->from_date, $course->until_date);
        }
        return $courses;
    }

    public function view(){
        $results = $this->getScheduledCourses();
        print TemplateEngine::template('./views/student/list.php', array( 'results' => $results, 'scheduled_courses' => $this ));
    }

}
?>