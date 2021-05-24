<?php

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the autoload file
require_once('vendor/autoload.php');
require_once('model/data-layer.php');
require_once('model/validation.php');

//Start a session
session_start();

//Instantiate the base class
$f3 = Base::instance();

//Define a default route
$f3->route('GET /', function () {
    // Display the home page
    $view = new Template();
    echo $view->render('views/home.html');
});

$f3->route('GET|POST /personal', function ($f3) {

    /* If the form has been submitted, add the data to session
     * and send the user to the next order form
    */
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //var_dump($_POST);
        $_SESSION = array();

        //Initialize variables to store user input
        $userFirst = "";
        $userLast = "";
        $userAge = "";
        $userPhone = "";
        $userGender = "";

        $userFirst = $_POST['fName'];
        $userLast = $_POST['lName'];
        $userAge = $_POST['age'];
        $userPhone = $_POST['pNum'];
        $userGender = $_POST['gender'];
        $_SESSION['gender'] = $userGender;

        if (validName($userFirst)) {
            $_SESSION['fName'] = $_POST['fName'];
        } else {
            $f3->set('errors["fname"]', "Please input a valid first name");
        }

        if (validName($userLast)) {
            $_SESSION['lName'] = $_POST['lName'];
        } else {
            $f3->set('errors["lname"]', "Please input a valid last name");
        }

        if (validAge($userAge)) {
            $_SESSION['age'] = $_POST['age'];
        } else {
            $f3->set('errors["age"]', "Please enter a valid age");
        }

        if (validPhone($userPhone)) {
            $_SESSION['pNum'] = $_POST['pNum'];
        } else {
            $f3->set('errors["pNum"]', "Please enter a valid phone number");
        }

        $f3->set('userFirst', $userFirst);
        $f3->set('userLast', $userLast);
        $f3->set('userAge', $userAge);
        $f3->set('userPhone', $userPhone);
        $f3->set('userGender', $userGender);
        if (empty($f3->get('errors'))) {
            header('location: profile');
        }
    }

    // Display the Personal info page
    $view = new Template();
    echo $view->render('views/personal_Info.html');
});

$f3->route('GET|POST /profile', function ($f3) {
    /* If the form has been submitted, add the data to session
    * and send the user to the next order form
    */
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //var_dump($_POST);

        //Initialize variables to store user input
        $userEmail = "";
        $userState = "";
        $userBio = "";
        $userSeeking = "";


        $userEmail = $_POST['email'];
        $userState = $_POST['state'];
        $userBio = $_POST['bio'];
        $userSeeking = $_POST['seeking'];

        if (validEmail($userEmail)) {
            $_SESSION['email'] = $userEmail;
        } else {
            $f3->set('errors["email"]', "Please enter a valid email address");
        }

        $_SESSION['state'] = $userState;
        $_SESSION['seeking'] = $userSeeking;
        $_SESSION['bio'] = $userBio;

        //Store the user input in the hive (Part of making the code sticky)
        $f3->set('userEmail', $userEmail);
        $f3->set('userState', $userState);
        $f3->set('userBio', $userBio);
        $f3->set('userSeeking', $userSeeking);

        if (empty($f3->get('errors'))) {
            header('location: interest');
        }
    }
    $f3->set('states', getStates());
    // Display the Profile page
    $view = new Template();
    echo $view->render('views/profile.html');
});

$f3->route('GET|POST /interest', function ($f3) {

    //Initialize variables to store user input as an array
    $userIndoor = array();
    $userOutdoor = array();

    /* If the form has been submitted, add the data to session
    * and send the user to the next order form
    */
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //var_dump($_POST);

        $userIndoor = $_POST['indoorInterests'];
        $userOutdoor = $_POST['outdoorInterests'];

        if (validIndoor($userIndoor)) {
            $_SESSION['indoor'] = implode(", ", $userIndoor);
        } else {
            $f3->set('errors["indoor"]', 'Please enter a valid interest');
        }

        if (validOutdoor($userOutdoor)) {
            $_SESSION['outdoor'] = implode(", ", $userOutdoor);
        } else {
            $f3->set('errors["outdoor"]', 'Please enter a valid interest');
        }
        if (empty($f3->get('errors'))) {
            header('location: summary');
        }

    }

    //Get both interest and then send them to the view
    $f3->set('indoor', getIndoors());
    $f3->set('outdoor', getOutdoors());

    //Store the user input in the hive (Part of making the code sticky)
    $f3->set('userIndoor', $userIndoor);
    $f3->set('userOutdoor', $userOutdoor);

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