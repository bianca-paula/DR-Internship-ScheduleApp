<?php
if(isset($_COOKIE['role']) && $_COOKIE['role'] == "professor"
    && isset($_COOKIE['logged_in']) && $_COOKIE['logged_in'] == "true")
{
    
    echo "HELLO, PROFESSOR!";
}
else
{
    header("Location: http://localhost/schedule/login.php");
    exit();
}
?>