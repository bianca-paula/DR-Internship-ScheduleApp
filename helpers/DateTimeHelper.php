<?php 
class DateTimeHelper{

  //@TO DO - move logo in template
  public static function getLogo(){
    return '<img src="../../assets/images/logo_books.png" alt="Logo Books" height="40em">';
  }

  public static function getHour(string $datetime){
    $dt = DateTime::createFromFormat("Y-m-d H:i:s", $datetime);
    $hour = $dt->format('H');
    return (int)$hour;
  }

  public static function getDayOfWeek(string $datetime){
    return date('l', strtotime($datetime));
  }

  public static function getFormattedDate(string $datetime){
    $dt = new DateTime($datetime);
    $date = $dt->format('d/m/y');
    return $date;
  }
}
?>