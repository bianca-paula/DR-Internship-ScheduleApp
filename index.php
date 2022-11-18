<?php
error_reporting(E_ERROR | E_PARSE);
include_once './utils/TemplateEngine.php';
include_once './utils/DBConfiguration.php';
include_once './controllers/RoutingController.php';
include_once './models/Course.php';
include_once './models/ScheduledCourse.php';
include_once './helpers/DateTimeHelper.php';
include_once './helpers/CourseAttendanceHelper.php';
include_once './controllers/StudentController.php';
require __DIR__ . '/vendor/autoload.php';
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// $attendance = new CourseAttendanceHelper($db);
// $attendance->populateAttendanceTable();

RoutingController::getRouteHandler();
?>
