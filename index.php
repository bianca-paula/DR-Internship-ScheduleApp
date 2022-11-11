<?php
error_reporting(E_ERROR | E_PARSE);
include_once './utils/DBConfiguration.php';
include_once './models/Course.php';
include_once './models/ScheduledCourse.php';
include_once './controllers/ScheduledCourseController.php';
include_once './utils/DBTables.php';
include_once './utils/DBData.php';
$db = new DbConfiguration();
$result = $db->execute("INSERT IGNORE INTO Room(name, capacity) values('Nicolae Iorga', 200), ('C1', 35), ('C2', 35), ('C3', 15)");
print_r (sizeof($result));
// $course = new Course($db, "","");
// $db->connection->query(Course::insertMockDataCourse());
// $db->connection->query(ScheduledCourse::insertMockData());
// $scheduled_course = new ScheduledCourse($db, 1, 1, "", "");
// $course_controller = new ScheduledCourseController($db);
// $course_controller->getCourses();
// $course_controller->getScheduledCourses();
