<?php 
function checkTable($table_name){
    return "SELECT table_name FROM information_schema.tables
    where table_name = $table_name;";
}

function getLogo(){
    return '<img src="../../assets/images/logo_books.png" alt="Logo Books" height="40em">';
}

function getHour(string $datetime){
  $dt = DateTime::createFromFormat("Y-m-d H:i:s", $datetime);
  $hour = $dt->format('H');
  return (int)$hour;
}

function getDayOfWeek(string $datetime){
  return date('l', strtotime($datetime));
}

function getFormattedDate(string $datetime){
    $dt = new DateTime($datetime);
    $date = $dt->format('d/m/y');
    return $date;
}
?>