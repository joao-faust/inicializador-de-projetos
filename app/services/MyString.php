<?php

namespace app\services;

class MyString
{
  public static function slice(string $str, int $maxLength)
  {
    return substr($str, 0, $maxLength);
  }

  public static function addLineBreak(string $str, int $maxPerLine)
  {
    $newStr = $str;

    $strSize = strlen($newStr);
    $strLines = $strSize / $maxPerLine;

    for ($i = 1; $i < $strLines; $i++) {
      $breakTagPosi = $i * $maxPerLine;
      $newStr = substr_replace($newStr, '<br />', $breakTagPosi, 0);
    }

    return $newStr;
  }

  public static function show(string $str)
  {
    return str_replace('&#13;', '<br />', nl2br($str));
  }

  public static function showOnTextArea(string $str)
  {
    return str_replace('<br />', '&#13;', nl2br($str));
  }
}
