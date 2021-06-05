<?php

class Controller
{
    private $_f3; // router

    /**
     * Controller constructor.
     * @param $_f3
     */
    public function __construct($f3)
    {
        $this->_f3 = $f3;
    }

    function home()
    {
        // Display the home page
        $view = new Template();
        echo $view->render('views/home.html');
    }

    function personal()
    {
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
                $this->_f3->set('errors["fname"]', "Please input a valid first name");
            }

            if (validName($userLast)) {
                $_SESSION['lName'] = $_POST['lName'];
            } else {
                $this->_f3->set('errors["lname"]', "Please input a valid last name");
            }

            if (validAge($userAge)) {
                $_SESSION['age'] = $_POST['age'];
            } else {
                $this->_f3->set('errors["age"]', "Please enter a valid age");
            }

            if (validPhone($userPhone)) {
                $_SESSION['pNum'] = $_POST['pNum'];
            } else {
                $this->_f3->set('errors["pNum"]', "Please enter a valid phone number");
            }

            $this->_f3->set('userFirst', $userFirst);
            $this->_f3->set('userLast', $userLast);
            $this->_f3->set('userAge', $userAge);
            $this->_f3->set('userPhone', $userPhone);
            $this->_f3->set('userGender', $userGender);
            if (empty($this->_f3->get('errors'))) {
                header('location: profile');
            }
        }

        // Display the Personal info page
        $view = new Template();
        echo $view->render('views/personal_Info.html');
    }

    function profile()
    {
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
                $this->_f3->set('errors["email"]', "Please enter a valid email address");
            }

            $_SESSION['state'] = $userState;
            $_SESSION['seeking'] = $userSeeking;
            $_SESSION['bio'] = $userBio;

            //Store the user input in the hive (Part of making the code sticky)
            $this->_f3->set('userEmail', $userEmail);
            $this->_f3->set('userState', $userState);
            $this->_f3->set('userBio', $userBio);
            $this->_f3->set('userSeeking', $userSeeking);

            if (empty($this->_f3->get('errors'))) {
                header('location: interest');
            }
        }
        $this->_f3->set('states', getStates());
        // Display the Profile page
        $view = new Template();
        echo $view->render('views/profile.html');
    }

    function interest()
    {
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
                $this->_f3->set('errors["indoor"]', 'Please enter a valid interest');
            }

            if (validOutdoor($userOutdoor)) {
                $_SESSION['outdoor'] = implode(", ", $userOutdoor);
            } else {
                $this->_f3->set('errors["outdoor"]', 'Please enter a valid interest');
            }
            if (empty($this->_f3->get('errors'))) {
                header('location: summary');
            }

        }

        //Get both interest and then send them to the view
        $this->_f3->set('indoor', getIndoors());
        $this->_f3->set('outdoor', getOutdoors());

        //Store the user input in the hive (Part of making the code sticky)
        $this->_f3->set('userIndoor', $userIndoor);
        $this->_f3->set('userOutdoor', $userOutdoor);

        // Display the Interest page
        $view = new Template();
        echo $view->render('views/Interest.html');
    }

    function summary()
    {
        // Display the summary page
        $view = new Template();
        echo $view->render('views/summary.html');

        // This might be problematic
        unset($_SESSION['biography']);
    }

}