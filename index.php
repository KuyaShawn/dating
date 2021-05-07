<?php

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Start a session
session_start();

//Require the autoload file
require_once('vendor/autoload.php');

//Instantiate the base class
$f3 = Base::instance();

//Define a default route
$f3->route('GET /', function (){
    // Display the home page
    $view = new Template();
    echo $view -> render('views/home.html');
});

$f3->route('GET|POST /personal', function (){

    /* If the form has been submitted, add the data to session
     * and send the user to the next order form
    */
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        var_dump($_POST);

        header('location: profile');
    }

    // Display the Personal info page
    $view = new Template();
    echo $view -> render('views/personal_Info.html');
});

$f3->route('GET /profile', function (){
    // Display the Profile page
    $view = new Template();
    echo $view -> render('views/profile.html');
});

$f3->route('GET /interest', function (){
    // Display the Interest page
    $view = new Template();
    echo $view -> render('views/interest.html');
});

$f3->route('GET /summary', function (){
    // Display the summary page
    $view = new Template();
    echo $view -> render('views/summary.html');
});

//Run fat free
$f3->run();