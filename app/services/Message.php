<?php

namespace app\services;

class Message
{
  public static function get()
  {
    if (isset($_SESSION['message']) and isset($_SESSION['type'])) {
      $data = [
        'message' => $_SESSION['message'],
        'type' => $_SESSION['type']
      ];

      self::destroy();

      return $data;
    }

    return false;
  }

  public static function set(string $message, string $type, string $page = '/')
  {
    $_SESSION['message'] = $message;
    $_SESSION['type'] = $type;

    if ($page === 'back') {
      header('Location:' . $_SERVER['HTTP_REFERER']);
    } else {
      header('Location:' . $page);
    }
    exit;
  }

  private static function destroy()
  {
    unset($_SESSION['message']);
    unset($_SESSION['type']);
  }
}
