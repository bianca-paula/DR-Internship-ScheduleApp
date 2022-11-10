<?php

use Dotenv\Dotenv;

require __DIR__ . '/vendor/autoload.php';



$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

include_once $_SERVER['DOCUMENT_ROOT'] . './utils/DbConfig.php';
include_once $_SERVER['DOCUMENT_ROOT'] . './models/Role.php';

$db_config = new DBConfig();
$role = new Role($db_config);
$role->insertRole("Student");
