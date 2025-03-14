<?php
declare(strict_types=1);
require "vendor/autoload.php";

// require 'credentials.php';

class Route {
  public static function handleBot(): void {
    $update = file_get_contents('php://input');

    global $token;
    if($update){
        (new bot())->handle($update);
        echo "Update tg";
        exit;
    }
    
  }

  public static function handleWeb(): void {
    require 'view.php';
  }
}