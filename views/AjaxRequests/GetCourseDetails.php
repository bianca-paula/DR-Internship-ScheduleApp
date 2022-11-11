<?php
error_reporting(E_ERROR | E_PARSE);

include_once '../../utils/DBConfiguration.php';
include_once '../../helpers/CourseHelper.php';
include_once '../../helpers/GeneralHelper.php';
include_once '../../models/ScheduledCourse.php';
include_once '../../models/Course.php';
include_once '../../models/Room.php';
include_once '../../helpers/ScheduledCourseHelper.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");

$db = new DbConfiguration();
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $scheduled_course_ID=$_GET['id'];
    $sql = "SELECT *
            FROM ScheduledCourse
            WHERE id = $scheduled_course_ID;";
    $statement = $db->connection->query($sql);
    $statement->setFetchMode(PDO::FETCH_OBJ);
    $courseObj = $statement->fetch();
    $scheduled_course = new ScheduledCourse($courseObj->id, $courseObj->room_id, $courseObj->course_id, $courseObj->from_date, $courseObj->until_date);
    $course_ID = $scheduled_course->getCourseID();
    $sql = "SELECT id, name, type
            FROM Course
            WHERE id = $course_ID;";
    $statement = $db->connection->query($sql);
    $statement->setFetchMode(PDO::FETCH_OBJ);
    $courseObj = $statement->fetch();
    $course = new Course($courseObj->id, $courseObj->name, $courseObj->type);
    $course_name = $course->getName();
    $course_type = $course->getType();
    printf('<h2 class="text-center">%s</h2>',$course_name);
    printf('<div class="ml-3">');
    echo "<h4>Type: $course_type</h4>";
    $room_ID = $scheduled_course->getRoomID();
    $sql = "SELECT id, name, capacity
            FROM Room
            WHERE id = $room_ID;";
    $statement = $db->connection->query($sql);
    $statement->setFetchMode(PDO::FETCH_OBJ);
    $courseObj = $statement->fetch();
    $room = new Room($courseObj->id, $courseObj->name, $courseObj->capacity);
    $room_name = $room->getName();
    $room_capacity = $room->getCapacity();
    echo "<h4>Room: $room_name</h4>";
    echo "<h4>Capacity: $room_capacity people</h4>";
    $curse_date = getFormattedDate($scheduled_course->getFromDate());
    echo "<h4>Date: $curse_date</h4>";
    $from_hour = getHour($scheduled_course->getFromDate());
    $until_hour = getHour($scheduled_course->getUntilDate());
    echo "<h4>Professor: </h4>";
    echo "<h4>Time: $from_hour - $until_hour</h4>";
    printf('</div>');
}
else{
    echo "<p>There is no course in the selected time slot!</p>";
}
?>