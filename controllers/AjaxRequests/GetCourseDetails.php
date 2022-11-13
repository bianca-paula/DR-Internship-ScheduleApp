<?php
error_reporting(E_ERROR | E_PARSE);
include_once '../../models/Course.php';
include_once '../../models/Room.php';
include_once '../../models/ScheduledCourse.php';
include_once '../../utils/DBConfiguration.php';
include_once '../../helpers/DateHelper.php';
include_once '../../helpers/ScheduledCourseHelper.php';
include_once '../../helpers/CourseHelper.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");

$db = new DbConfiguration();
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $scheduled_course_id = $_GET['id'];
    $query = ScheduledCourseHelper::getScheduledCourseDetails();
    $scheduled_course_object = $db->execute($query, [$scheduled_course_id])->fetch();
    if(!$scheduled_course_object){
        throw new Exception("Invalid scheduled course ID!");
    }
    else{
        echo json_encode($scheduled_course_object);
    }
}
else{
    echo "<p>There is no course in the selected time slot!</p>";
}
?>