<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
include_once './utils/DBConfiguration.php';
include_once '../models/Course.php';
include_once './helpers/CourseHelper.php';
include_once './helpers/ScheduledCourseHelper.php';

class ScheduledCourseController{

    private DbConfiguration $db;
    private CourseHelper $course_helper;
    private ScheduledCourseHelper $scheduled_course_helper;
    public function __construct(DbConfiguration $db){
        $this->db=$db;
        $this->course_helper = new CourseHelper($db);
        $this->scheduled_course_helper = new ScheduledCourseHelper($db);
    }

    public function getCourseById(int $course_id){
        $course = $this->course_helper->getCourseById($course_id);
        return $course;
    }

    public function getScheduledCourses(){
        $scheduled_courses = $this->scheduled_course_helper->getScheduledCourses();
        return $scheduled_courses;
    }
    
    
    public function getScheduleForUser(int $user_id){
        $sql = "SELECT scheduledcourse.id as id, scheduledcourse.course_id as course_id, room_id, from_date, until_date FROM scheduledcourse INNER JOIN
                    (
                        SELECT course_id FROM
                        groupuser INNER JOIN groupcourse ON groupuser.group_id = groupcourse.group_id
                        WHERE user_id = " . $user_id . "
                    ) as assignedcourses
                            
            ON assignedcourses.course_id = scheduledcourse.course_id";
        $statement = $this->db->connection->query($sql);
        $scheduled_courses_array = $statement->fetchAll(PDO::FETCH_OBJ);
        $scheduled_courses = $this->convertToScheduledCourses($scheduled_courses_array);
        return $scheduled_courses;
    }


    public function getScheduledCourseById(int $scheduled_course_id){
        $scheduled_course = $this->scheduled_course_helper->getScheduledCourseByID($scheduled_course_id);
        return $scheduled_course;
    }

    public function getScheduledCourseDetails($scheduled_course_id){
            $scheduled_course_object = $this->scheduled_course_helper->getScheduledCourseDetails($scheduled_course_id);
            if(!$scheduled_course_object){
                ErrorPageController::view("Invalid scheduled course ID!");
            }
            else{
                echo json_encode($scheduled_course_object);
            }
    }

    public function view(){
        $results = $this->getScheduledCourses();
        define('WEEKDAYS', array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'));
        print TemplateEngine::template('./views/student/list.php', array( 'results' => $results, 'WEEKDAYS' => WEEKDAYS, 'scheduled_courses' => $this ));
    }

    public function checkTimePeriodIsFree($scheduled_courses_array, $starting_date){
        foreach($scheduled_courses_array as $course){
            if($course->from_date == $starting_date)
                return false;
        }
        return true;
    }

    public function getAlternativesForCourse(){
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['scheduled_id'])) {
            printf("<tbody> <tr> <th> Alternatives </th> </tr>");
            
            // Get scheduled course
            $query = ScheduledCourseHelper::getScheduledCourseQuery();
            $scheduled_course = $db->execute($query, array("scheduled_course_ID" => $_GET['scheduled_id'])) -> fetch();
            $course_id =  $scheduled_course["course_id"];
            
            // Get course from scheduled course
            $query = CourseHelper::getCourseQuery();
            $course = $db->execute($query, array('course_id' => $course_id))->fetch();
            
            $name = $course["name"];
            $type = $course["type"];
            
            // Get all courses of the same type and name
            $query = ScheduledCourseHelper::getUnfilteredAlternativesForCourse($name, $type);
            $alternatives_array = $db->execute($query)->fetchAll();
              
            // Add alternatives to the table
            foreach($alternatives_array as $alternative){
                    $scheduled_id = $alternative["scheduled_id"];
                    $from_date = $alternative["from_date"];
                    $until_date = $alternative["until_date"];
                    $weekday = DateTimeHelper::getDayOfWeek($from_date);
                    $start_hour = DateTimeHelper::getHour($from_date);
                    $end_hour = DateTimeHelper::getHour($until_date);
                    printf("<tr> <td ondblclick = changeCourse('%s') }> %s </td> </tr>",
                        $_GET['scheduled_id'] . "','" .$scheduled_id . "','" . $name . "','" . $type . "','" . $weekday . "','" . $start_hour . "','" . $end_hour, // changeCourse parameters
                        $weekday. ": ". $start_hour." - " . $end_hour); // table data
                //}
            }
            
            printf("</tbody><thead class=''></thead>");
        }
        else{
            echo "No course selected";
        }
    }
}
?>