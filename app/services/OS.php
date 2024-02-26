<?php

namespace app\services;

class OS
{
  public static function getHomePath()
  {
    if (PHP_OS === 'WINNT') {
      return getenv('USERPROFILE');
    }
    return getenv('HOME');
  }

  public static function runCommand(string $command)
  {
    shell_exec($command);
  }
}
