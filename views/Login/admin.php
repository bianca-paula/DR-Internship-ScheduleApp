<?php


if(isset($_COOKIE['role']) && $_COOKIE['role'] == "admin"
    && isset($_COOKIE['logged_in']) && $_COOKIE['logged_in'] == "true")
{
        
    echo "HELLO, " . $_COOKIE['role'] . "! <br />";
}
else
{
    header("Location: http://localhost/DR-Internship-ScheduleApp/views/Login/login.php");
    exit();
}





?>