<?php

require_once('vendor/autoload.php');

session_start();

use app\services\Message;
use app\services\Utils;

$baseUrl = Utils::baseUrl();

$message = Message::get();
