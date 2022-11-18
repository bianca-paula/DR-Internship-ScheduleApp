<?php

header("Access-Control-Allow-origin: *");
header("Access-Control-Allow-Methods: GET");
include_once '../utils/DBConfiguration.php';
include_once '../models/Course.php';
include_once '../models/Room.php';
include_once '../helpers/CourseHelper.php';
include_once '../helpers/ScheduledCourseHelper.php';
include_once '../helpers/RoomHelper.php';
include_once '../utils/TemplateEgine.php';

class ProfessorScheduleController {

    private DBConfiguration $db;
    private CourseHelper $course_helper;
    private ScheduledCourseHelper $scheduled_course_helper;
    private RoomHelper $room_helper;

    public function __construct(DBConfiguration $db) {
        $this->db = $db;
        $this->course_helper = new CourseHelper($db);
        $this->scheduled_course_helper = new ScheduledCourseHelper($db);
        $this->room_helper = new RoomHelper($db);
    }

    public static function getCourseById(int $course_id) {
        $course = $this->course_helper->getCourseById($course_id);
        return $course;
    }

    public function getRoomById (int $room_id) {
        $room = $this->room_helper->getRoomById($db);
        return $room;
    }

    public function view() {
        $results = $this->getCoursesForProfessor();
        $room = $this->getRoomName();
        $scheduled_courses = $this->getScheduledCourseForProfessor();
        define('WEEKDAYS', array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'));
        print TemplateEngine::template('./views/ProfessorPage/professorPage.php', array('results' => $results, 'room' => $room, 'scheduled_courses' => $scheduled_courses, 'WEEKDAYS' => WEEKDAYS));
    }

    public function checkTimePeriodIsFree($scheduled_courses_array, $starting_date) {
        foreach($scheduled_Courses_array as $course) {
            if($course->from_Date == $starting_date) 
            return false;
        }
        return true;
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

    public function getCoursesForProfessor() {
        $prof_id = 1;
        return $this->course_helper->getCoursesForProf($prof_id);
    }

    public function getRoomName() {
        $room_id = 2;
        return $this->room_helper->getRoomForProf($room_id);
    }


    public function getScheduledCourseForProfessor() {
        $scheduled_course_id = 1;
        return $this->scheduled_course_helper->getScheduledCoursesForProf($scheduled_course_id);
    }
}

?>