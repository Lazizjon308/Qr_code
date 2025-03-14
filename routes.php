<?php
declare(strict_types=1);
require "vendor/autoload.php";
use Route\Route;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && strpos($_SERVER['CONTENT_TYPE'] ?? '', 'application/json') !== false) 
{
    Route::handleBot();
}else{
    Route::handleWeb();
}