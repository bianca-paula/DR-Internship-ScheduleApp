<?php
error_reporting(E_ERROR | E_PARSE);
include_once './utils/TemplateEngine.php';
include_once './utils/DBConfiguration.php';
include_once './controllers/RoutingController.php';

$db = new DbConfiguration();
$scheduled_courses = new ScheduledCourseController($db);

$router = new RoutingController($db, $scheduled_courses);
$request = $_SERVER['REQUEST_URI'];

include_once './views/page-parts/Header.php';

$router->getRouteHandler($request);

include_once './views/page-parts/Footer.php'
?>
