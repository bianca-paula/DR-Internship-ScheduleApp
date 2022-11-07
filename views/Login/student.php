<?php

if(isset($_COOKIE['role']) && $_COOKIE['role'] == "student"
    && isset($_COOKIE['logged_in']) && $_COOKIE['logged_in'] == "true")
{
    
    echo "HELLO, STUDENT!";
}
else
{
    header("Location: http://localhost/schedule/login.php");
    exit();
}

?>