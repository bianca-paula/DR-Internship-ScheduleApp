<?php

// include_once '../../utils/DBConfiguration.php';
// include_once '../../helpers/ScheduledCourseHelper.php';
// include_once '../../helpers/CourseHelper.php';
// include_once '../../helpers/DateTimeHelper.php';
// include_once '../../helpers/DBHelper.php';
// include_once '../../helpers/CourseHelper.php';


// header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Methods: GET");


// function checkTimePeriodIsFree($scheduled_courses_array, $starting_date){
//     foreach($scheduled_courses_array as $course){
//         if($course->from_date == $starting_date)
//             return false;
//     }
//     return true;
// }


// $db = new DbConfiguration();
// if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['scheduled_id'])) {
//     printf("<tbody> <tr> <th> Alternatives </th> </tr>");
    
//     // Get scheduled course
//     $query = ScheduledCourseHelper::getScheduledCourseQuery();
//     $scheduled_course = $db->execute($query, array("scheduled_course_ID" => $_GET['scheduled_id'])) -> fetch();
//     $course_id =  $scheduled_course["course_id"];
    
//     // Get course from scheduled course
//     $query = CourseHelper::getCourseQuery();
//     $course = $db->execute($query, array('course_id' => $course_id))->fetch();
    
//     $name = $course["name"];
//     $type = $course["type"];
    
//     // Get all courses of the same type and name
//     $query = ScheduledCourseHelper::getUnfilteredAlternativesForCourse($name, $type);
//     $alternatives_array = $db->execute($query)->fetchAll();
    
    
    
      
//     // Add alternatives to the table
//     foreach($alternatives_array as $alternative){
//         //if (getDayOfWeek($alternative->from_date) == getDayOfWeek(date("yyyy-mm-dd hh:ii:ss"))){ // To change to same week of year
//             $scheduled_id = $alternative["scheduled_id"];
//             $from_date = $alternative["from_date"];
//             $until_date = $alternative["until_date"];
//             $weekday = DateTimeHelper::getDayOfWeek($from_date);
//             $start_hour = DateTimeHelper::getHour($from_date);
//             $end_hour = DateTimeHelper::getHour($until_date);
//             printf("<tr> <td ondblclick = changeCourse('%s') }> %s </td> </tr>",
//                 $_GET['scheduled_id'] . "','" .$scheduled_id . "','" . $name . "','" . $type . "','" . $weekday . "','" . $start_hour . "','" . $end_hour, // changeCourse parameters
//                 $weekday. ": ". $start_hour." - " . $end_hour); // table data
//         //}
//     }
    
//     printf("</tbody><thead class=''></thead>");
// }
// else{
//     echo "No course selected";
// }
 ?> 