<?php

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the autoload file
require_once('vendor/autoload.php');

//Start a session
session_start();

//Instantiate the base class
$f3 = Base::instance();
$controller = new Controller($f3);

//Define a default route
$f3->route('GET /', function () {
    $GLOBALS['controller']->home();
});

$f3->route('GET|POST /personal', function () {
    $GLOBALS['controller']->personal();
});

$f3->route('GET|POST /profile', function () {
    $GLOBALS['controller']->profile();
});

$f3->route('GET|POST /interest', function () {
    $GLOBALS['controller']->interest();
});

$f3->route('GET /summary', function () {
    $GLOBALS['controller']->summary();
});

//Run fat free
$f3->run();