<?php
declare(strict_types=1);

require './vendor/autoload.php';


use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();
require 'view.php';


require 'routes.php';