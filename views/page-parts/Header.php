<?php 
error_reporting(E_ERROR | E_PARSE);
include_once './utils/DBConfiguration.php';
include_once './models/Course.php';
include_once './models/ScheduledCourse.php';
include_once './helpers/DateTimeHelper.php';
include_once './controllers/ScheduledCourseController.php';
$db = new DbConfiguration();
$scheduled_courses = new ScheduledCourseController($db);
$results = $scheduled_courses->getScheduledCourses();
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap and Bootstrap Table -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.21.1/dist/bootstrap-table.min.css">
    <!-- App Style -->
    <link rel="stylesheet" href="./assets/style/style.css">
    <!-- Google Fonts && Font Awesome -->
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<div class="container-fluid">
    <header>
        <div class="row header-container py-3">
            <div class="col-4 pl-5">
                <h3><img src="./assets/images/logo_books.png" alt="Logo Books" height="40em">&nbsp;ScheduleApp</h3>
            </div>
            <div class="col-4"></div>
            <div class="col-4 pr-5">
                <h3 class="float-right">Username &nbsp;<span onclick="logoutPage()"><i class="fa-solid fa-right-from-bracket"></span></i></h3>
            </div>
        </div>
    </header>
</div>
