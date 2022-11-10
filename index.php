<?php

use Dotenv\Dotenv;

require __DIR__ . '/vendor/autoload.php';



$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

include_once $_SERVER['DOCUMENT_ROOT'] . './utils/DbConfig.php';
include_once $_SERVER['DOCUMENT_ROOT'] . './models/Role.php';
include_once $_SERVER['DOCUMENT_ROOT'] . './helpers/InsertDataHelper.php';

$db_config = new DBConfig();
$role = new Role($db_config);

InsertDataHelper::insertRole($db_config,"Student");
InsertDataHelper::insertRole($db_config,"Admin");
InsertDataHelper::insertRole($db_config,"Professor");
