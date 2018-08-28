<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require 'vendor/autoload.php';

try {
    (new \yk\core\Application('/appconfig.json'))->start();
} catch (Exception $exception) {
    echo $exception->getMessage();
}
