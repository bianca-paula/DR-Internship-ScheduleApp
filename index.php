<?php
error_reporting(E_ERROR | E_PARSE);
define('ROOT',__DIR__);
include_once './utils/TemplateEngine.php';
include_once './utils/DBConfiguration.php';
include_once './models/Course.php';
include_once './models/ScheduledCourse.php';
include_once './controllers/RoutingController.php';
include_once './controllers/ScheduledCourseController.php';
include_once './helpers/DateTimeHelper.php';
include_once './controllers/AdminController.php';
require ROOT .'/vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(ROOT);
$dotenv->load();

$db = new DbConfiguration();
$scheduled_courses = new ScheduledCourseController($db);
$admin = new AdminController($db);
$router = new RoutingController($db,$scheduled_courses,$admin);
$request = $_SERVER['REQUEST_URI'];
$router->getRouteHandler($request);
