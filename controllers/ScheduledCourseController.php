<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
include_once './utils/DBConfiguration.php';
include_once '../models/Course.php';
include_once './helpers/CourseHelper.php';
include_once './helpers/ScheduledCourseHelper.php';

class ScheduledCourseController{

    private DbConfiguration $db;
    public function __construct(DbConfiguration $db){
        $this->db=$db;
    }
    public function getCourseById(int $course_id){
        $sql = CourseHelper::getCourseQuery();
        $courseObj = $this->db->execute($sql, array('course_id' => $course_id))->fetch();
        $course = new Course($courseObj['id'], $courseObj['name'], $courseObj['type']);
        return $course;
    }

    public function getScheduledCourses(){
        $sql = ScheduledCourseHelper::getScheduledCoursesQuery();
        $statement = $this->db->connection->query($sql);
        $scheduled_courses_array = $statement->fetchAll(PDO::FETCH_OBJ);
        $scheduled_courses = $this->convertToScheduledCourses($scheduled_courses_array);
        return $scheduled_courses;
    }

    public function getScheduledCourseById(){
        $sql = ScheduledCourseHelper::getScheduledCourseQuery();
        $statement = $this->db->connection->query($sql);
        $statement->setFetchMode(PDO::FETCH_OBJ);
        $scheduled_course = $statement->fetch();
        $scheduled_courseObj = $this->convertToScheduledCourses($scheduled_course);
        return $scheduled_courseObj;
    }

    public function getScheduledCourseDetails(){
        // if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
            $scheduled_course_id = $_GET['id'];
            $query = ScheduledCourseHelper::getScheduledCourseDetails();
            $scheduled_course_object = $this->db->execute($query, [$scheduled_course_id])->fetch();
            if(!$scheduled_course_object){
                ErrorPageController::view("Invalid scheduled course ID!");
            }
            else{
                echo json_encode($scheduled_course_object);
            }
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
        define('WEEKDAYS', array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'));
        print TemplateEngine::template('./views/student/list.php', array( 'results' => $results, 'WEEKDAYS' => WEEKDAYS, 'scheduled_courses' => $this ));
    }
}
?>