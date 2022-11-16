<?php
include_once '../utils/DBConfiguration.php';
include_once '../models/Course.php';
include_once '../helpers/GeneralHelper.php';
include_once '../helpers/CourseHelper.php';
include_once '../helpers/ScheduledCourseHelper.php';

class ScheduledCourseController{

    private DbConfiguration $db;
    public function __construct(DbConfiguration $db){
        $this->db=$db;
        $this->course_helper = new CourseHelper($db);
        $this->scheduled_course_helper = new ScheduledCourseHelper($db);
    }
    public function getCourseById(int $course_id){
        // $sql = getCourseQuery($course_id);
        $sql="SELECT *
        FROM Course
        WHERE id = $course_id;";
        $statement = $this->db->connection->query($sql);
        $statement->setFetchMode(PDO::FETCH_OBJ);
        $courseObj = $statement->fetch();
        $course = new Course($courseObj->id, $courseObj->name, $courseObj->type);
        return $course;
    }

    public function getScheduledCourses()
    {
        $scheduled_courses = $this->scheduled_course_helper->getScheduledCourses();
        return $scheduled_courses;
    }

    public function getScheduledCourseById(int $scheduled_coourse_id){
        $scheduled_course = $this->scheduled_course_helper->getScheduledCourseByID($scheduled_coourse_id);
        return $scheduled_course;
    }

    public function getScheduledCourseDetails()
    {
        // if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
        $scheduled_course_id = $_GET['id'];
        $query = $this->getScheduledCourseDetails();
        $scheduled_course_object = $this->db->execute($query, array('scheduled_course_id' => $scheduled_course_id))->fetch();
        if (!$scheduled_course_object) {
            ErrorPageController::view("Invalid scheduled course ID!");
        } else {
            echo json_encode($scheduled_course_object);
        }
    }

    public function view()
    {
        $results = $this->getScheduledCourses();
        define('WEEKDAYS', array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'));
        print TemplateEngine::template('./views/student/list.php', array('results' => $results, 'WEEKDAYS' => WEEKDAYS, 'scheduled_courses' => $this));
    }

}
?>