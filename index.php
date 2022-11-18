<?php
error_reporting(E_ERROR | E_PARSE);
include_once './utils/TemplateEngine.php';
include_once './utils/DBConfiguration.php';
include_once './controllers/RoutingController.php';
include_once './models/Course.php';
include_once './models/ScheduledCourse.php';
include_once './helpers/DateTimeHelper.php';
include_once './controllers/ScheduledCourseController.php';
include_once '.controllers/ProfessorScheduleController.php';
require __DIR__ . '/vendor/autoload.php';
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$db = new DbConfiguration();
$scheduled_courses = new ScheduledCourseController($db);
$professor_Schedule = new ProfessorScheduleController($db);
$router = new RoutingController($db, $scheduled_courses, $professor_Schedule);
$request = $_SERVER['REQUEST_URI'];
$router->getRouteHandler($request);
?>
