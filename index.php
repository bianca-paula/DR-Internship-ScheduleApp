<?php
error_reporting(E_ERROR | E_PARSE);
define('ROOT',__DIR__);
include_once './utils/TemplateEngine.php';
include_once './utils/DBConfiguration.php';
include_once './models/Course.php';
include_once './models/ScheduledCourse.php';
include_once './helpers/DateTimeHelper.php';
include_once './helpers/CourseAttendanceHelper.php';
include_once './controllers/StudentController.php';
include_once './controllers/RoutingController.php';
require __DIR__ . '/vendor/autoload.php';
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(ROOT);
$dotenv->load();


RoutingController::getRouteHandler();
?>
