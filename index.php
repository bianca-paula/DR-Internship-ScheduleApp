<?php
include_once './TemplateEngine.php';
$myfile='./views/student/list.php';
$rows = array();
$output = '';
$output = TemplateEngine::template( $myfile, $rows );
print $output;


?>