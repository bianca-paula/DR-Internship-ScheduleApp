<?php  

use Dotenv\Dotenv;

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

var_dump($_ENV);

include_once './config/DBConfiguration.php';
include_once './models/Room.php';

$connection = new DBConfiguration();
$room = new Room($connection, '', '');

?>