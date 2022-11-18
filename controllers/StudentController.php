<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
include_once './utils/DBConfiguration.php';
include_once '../models/Course.php';
include_once './helpers/CourseHelper.php';
include_once './helpers/ScheduledCourseHelper.php';
include_once './helpers/DateTimeHelper.php';

class StudentController{

    private DbConfiguration $db;
    private CourseHelper $course_helper;
    private ScheduledCourseHelper $scheduled_course_helper;
    public function __construct(){
        $this->db = new DbConfiguration();
        $this->course_helper = new CourseHelper($this->db);
        $this->scheduled_course_helper = new ScheduledCourseHelper($this->db);
    }

    public function getCourseById(int $course_id){
        $course = $this->course_helper->getCourseById($course_id);
        return $course;
    }

    public function replaceCourseWithAlternative(){
        $user_id = $_COOKIE['user_id'];
        $previous_course_id = $_POST["previous_course_id"];
        $alternative_course_id = $_POST["alternative_course_id"];
        $course_name = $_POST["course_name"];
        $course_type = $_POST["course_type"];
        $this->scheduled_course_helper->updateCourseAttendanceForUser($user_id, $course_name, $course_type);
        $this->scheduled_course_helper->createAttendancesForAlternativeCourse($user_id, $alternative_course_id);
        echo true;
    }

    public function getScheduledCourses(){
        $user_id = $_COOKIE['user_id'];
        $scheduled_courses_array = $this->scheduled_course_helper->getScheduledCoursesForUser($user_id);
        $scheduled_courses = $this->convertToScheduledCourses($scheduled_courses_array);
        return $scheduled_courses;
    }
    
    // public function getScheduleForUser(int $user_id){
    //     $schedule_course = $this->scheduled_course_helper->getScheduledCourseByUser($user_id);
    //     $scheduled_courses = $this->convertToScheduledCourses($scheduled_courses_array);
    //     return $scheduled_courses;
    // }


    public function getScheduledCourseById(int $scheduled_course_id){
        $scheduled_course = $this->scheduled_course_helper->getScheduledCourseByID($scheduled_course_id);
        return $scheduled_course;
    }

    public function getScheduledCourseDetails(){
            $scheduled_course_id = $_GET["scheduled_course_id"];
            $scheduled_course_object = $this->scheduled_course_helper->getScheduledCourseDetails($scheduled_course_id);
            if(!$scheduled_course_object){
                ErrorPageController::view("Selected course doesn't exist!");
            }
            else{
                echo json_encode($scheduled_course_object);
            }
    }

    public function updateCourseAttendanceForUser(){
        // $user_id = $_POST["user_id"];
        $user_id = $_COOKIE['user_id'];
        $course_name = $_POST["course_name"];
        $course_type = $_POST["course_type"];
        $this->scheduled_course_helper->updateCourseAttendanceForUser($user_id, $course_name, $course_type);
        echo true;

    }

    public function checkTimePeriodIsFree($scheduled_courses_array, $starting_date){
        foreach($scheduled_courses_array as $course){
            if($course->from_date == $starting_date)
                return false;
        }
        return true;
    }

    public function getAlternativesForCourse(){
        $course_id = $_GET["course_id"];
        $this->scheduled_course_helper->getAlternatives($course_id);
    }

    public function convertToScheduledCourses($all_scheduled_courses){
        $scheduled_courses_array = [];
        foreach($all_scheduled_courses as $scheduled_course){ 
            $scheduled_course_map["scheduled_course"] = new ScheduledCourse($scheduled_course['id'], $scheduled_course['room_id'], 
                                                        $scheduled_course['course_id'], $scheduled_course['course_name'],
                                                        $scheduled_course['course_type'], $scheduled_course['from_date'], 
                                                        $scheduled_course['until_date']);
            $scheduled_course_map["from_hour"] = DateTimeHelper::getHour($scheduled_course['from_date']);
            $scheduled_course_map["until_hour"] = DateTimeHelper::getHour($scheduled_course['until_date']);
            $scheduled_course_map["day_of_week"] = DateTimeHelper::getDayOfWeek($scheduled_course['from_date']);

            $scheduled_courses_array[] = $scheduled_course_map;
        }
        return $scheduled_courses_array;
    }

    public function view(){
        $scheduled_courses = $this->getScheduledCourses();
        define('WEEKDAYS', array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'));
        print TemplateEngine::template('./views/student/list.php', array( 'all_scheduled_courses' => $scheduled_courses, 'WEEKDAYS' => WEEKDAYS));
    }
}
?>