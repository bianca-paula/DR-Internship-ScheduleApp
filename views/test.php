<?php

include_once "../utils/DbConfiguration.php";
include_once "../models/Group.php";
include_once "../models/User.php";


$db = new DbConfiguration();
$group = new Group($db, "aaa");

$user = new User($db, "", "", "", "", "");
echo $user->verifyUser("test@studmail.com", "test")->get_email() . "<br />";
echo $user->verifyUser("test@studmail.com", "test")->get_first_name() . "<br />";
echo $user->verifyUser("test@studmail.com", "test")->get_id(). "<br />";
echo $user->verifyUser("test@studmail.com", "test")->get_last_name() . "<br />";
echo $user->verifyUser("test@studmail.com", "test")->get_password() . "<br />";
echo $user->verifyUser("test@studmail.com", "test")->get_prefix();


?>