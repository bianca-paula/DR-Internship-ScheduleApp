<?php
error_reporting(E_ERROR | E_PARSE);
include_once './utils/TemplateEngine.php';
include_once './utils/DBConfiguration.php';


$myfile='./views/student/list.php';
$rows = array();
$output = '';
$output = TemplateEngine::template( $myfile, $rows );
print $output;


?>