<?php

include_once '../../utils/DBConfiguration.php';
include_once '../../helpers/ScheduledCourseHelper.php';
include_once '../../helpers/CourseHelper.php';
include_once '../../helpers/GeneralHelper.php';


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");


function checkTimePeriodIsFree($scheduled_courses_array, $starting_date){
    foreach($scheduled_courses_array as $course){
        if($course->from_date == $starting_date)
            return false;
    }
    return true;
}


$db = new DbConfiguration();
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['scheduled_id'])) {
    printf("<tbody> <tr> <th> Alternatives </th> </tr>");
    
    // Get scheduled course
    $query = getScheduledCourseQuery($_GET['scheduled_id']);
    $statement = $db->connection->query($query);
    $scheduled_course_as_array = $statement->fetchAll(PDO::FETCH_OBJ);
    $scheduled_course = $scheduled_course_as_array[0];
    $course_id =  $scheduled_course -> course_id;
    
    // Get course from scheduled course
    $query = getCourseQuery($course_id);
    $statement = $db->connection->query($query);
    $courses_array = $statement->fetchAll(PDO::FETCH_OBJ);
    
    $name = $courses_array[0]->name;
    $type = $courses_array[0]->type;
    
    // Get all courses of the same type and name
    $query = getUnfilteredAlternativesForCourse($name, $type);
    $statement = $db->connection->query($query);
    $alternatives_array = $statement->fetchAll(PDO::FETCH_OBJ);
    
    
    
    
      
    // Add alternatives to the table
    foreach($alternatives_array as $alternative){
        //if (getDayOfWeek($alternative->from_date) == getDayOfWeek(date("yyyy-mm-dd hh:ii:ss"))){ // To change to same week of year
            $scheduled_id = $alternative->scheduled_id;
            $from_date = $alternative->from_date;
            $until_date = $alternative->until_date;
            $weekday = getDayOfWeek($from_date);
            $start_hour = getHour($from_date);
            $end_hour = getHour($until_date);
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
?>