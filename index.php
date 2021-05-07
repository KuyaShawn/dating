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
$f3->route('GET /', function () {
    // Display the home page
    $view = new Template();
    echo $view->render('views/home.html');
});

$f3->route('GET|POST /personal', function () {

    /* If the form has been submitted, add the data to session
     * and send the user to the next order form
    */
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //var_dump($_POST);
        $_SESSION['fName'] = $_POST['fName'];
        $_SESSION['lName'] = $_POST['lName'];
        $_SESSION['age'] = $_POST['age'];
        $_SESSION['gender'] = $_POST['gender'];
        $_SESSION['pNum'] = $_POST['pNum'];
        header('location: profile');
    }

    // Display the Personal info page
    $view = new Template();
    echo $view->render('views/personal_Info.html');
});

$f3->route('GET|POST /profile', function () {
    /* If the form has been submitted, add the data to session
    * and send the user to the next order form
    */
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //var_dump($_POST);
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['state'] = $_POST['state'];
        $_SESSION['seeking'] = $_POST['seeking'];
        $_SESSION['bio'] = $_POST['bio'];

        header('location: interest');
    }

    // Display the Profile page
    $view = new Template();
    echo $view->render('views/profile.html');
});

$f3->route('GET|POST /interest', function () {

    /* If the form has been submitted, add the data to session
    * and send the user to the next order form
    */
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //var_dump($_POST);
        $_SESSION['in_door'] = implode(" ", $_POST['in_door']);
        $_SESSION['out_door'] = implode(' ', $_POST['out_door']);

        header('location: summary');
    }

    // Display the Interest page
    $view = new Template();
    echo $view->render('views/Interest.html');
});

$f3->route('GET /summary', function () {
    // Display the summary page
    $view = new Template();
    echo $view->render('views/summary.html');
});

//Run fat free
$f3->run();