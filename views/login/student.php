<?php

if(isset($_COOKIE['user_role']) && $_COOKIE['user_role'] == "student"
    && isset($_COOKIE['logged_in']) && $_COOKIE['logged_in'] == "true")
{
    
    echo "HELLO, " . $_COOKIE['user_role'] . "! <br />";
}
else
{
    header("Location: http://localhost/DR-Internship-ScheduleApp/views/Login/LoginPage.php");
    exit();
}

?>