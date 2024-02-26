<?php

namespace app\services;

class Utils
{
  public static function baseUrl()
  {
    return
      'http://' .
      $_SERVER['SERVER_NAME'] .
      dirname($_SERVER["REQUEST_URI"] . '?')
    ;
  }
}
