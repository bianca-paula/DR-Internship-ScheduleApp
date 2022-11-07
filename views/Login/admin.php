<?php


if(isset($_COOKIE['role']) && $_COOKIE['role'] == "admin"
    && isset($_COOKIE['logged_in']) && $_COOKIE['logged_in'] == "true")
{
        
    echo "HELLO, ADMIN!";
}
else
{
    header("Location: http://localhost/schedule/login.php");
    exit();
}





?>