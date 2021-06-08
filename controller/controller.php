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

            // When user clicks on the premium checkbox
            $userPremium = isset($_POST['premium']);
            if ($userPremium) {
                $_SESSION['user'] = new PremiumMember();
            } else {
                $_SESSION['user'] = new Member();
            }

            $userFirst = $_POST['fName'];
            if (Validation::validName($userFirst)) {
                $_SESSION['user']->setFname($userFirst);
            } else {
                $this->_f3->set('errors["fname"]', "Please input a valid first name");
            }

            $userLast = $_POST['lName'];
            if (Validation::validName($userLast)) {
                $_SESSION['user']->setLname($userLast);
            } else {
                $this->_f3->set('errors["lname"]', "Please input a valid last name");
            }

            $userAge = $_POST['age'];
            if (Validation::validAge($userAge)) {
                $_SESSION['user']->setAge($userAge);
            } else {
                $this->_f3->set('errors["age"]', "Please enter a valid age");
            }

            $userPhone = $_POST['pNum'];
            if (Validation::validPhone($userPhone)) {
                $_SESSION['user']->setPhone($userPhone);
            } else {
                $this->_f3->set('errors["pNum"]', "Please enter a valid phone number");
            }

            $userGender = $_POST['gender'];
            if (!is_null($userGender)) {
                $_SESSION['user']->setGender($userGender);
            } else {
                $this->_f3->set('errors["gender"]', "Please select a valid gender");
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

            $userEmail = $_POST['email'];
            if (Validation::validEmail($userEmail)) {
                $_SESSION['user']->setEmail($userEmail);
            } else {
                $this->_f3->set('errors["email"]', "Please enter a valid email address");
            }

            $userSeeking = $_POST['seeking'];
            if (!is_null($userSeeking)) {
                $_SESSION['user']->setSeeking($userSeeking);
            } else {
                $this->_f3->set('errors["seeking"]', "Please choose the gender you're interested in");
            }

            $userState = $_POST['state'];
            $_SESSION['user']->setState($userState);

            $userBio = $_POST['bio'];
            $_SESSION['user']->setBio($userBio);

            //Store the user input in the hive (Part of making the code sticky)
            $this->_f3->set('userEmail', $userEmail);
            $this->_f3->set('userState', $userState);
            $this->_f3->set('userBio', $userBio);
            $this->_f3->set('userSeeking', $userSeeking);

            if (empty($this->_f3->get('errors'))) {
                header('location: interest');
            }
        }
        $this->_f3->set('states', DataLayer::getStates());
        // Display the Profile page
        $view = new Template();
        echo $view->render('views/profile.html');
    }

    function interest()
    {
        if ($_SESSION['user'] instanceof PremiumMember) {
            //Initialize variables to store user input as an array
            $userIndoor = array();
            $userOutdoor = array();

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $userIndoor = $_POST['indoorInterests'] == null ? array() : $_POST['indoorInterests'];
                $userOutdoor = $_POST['outdoorInterests'] == null ? array() : $_POST['outdoorInterests'];

                if (Validation::validIndoor($userIndoor)) {
                    $_SESSION['user']->setInDoorInterests($userIndoor);
                } else {
                    $this->_f3->set('errors["indoor"]', "Please enter a valid interest");
                }

                if (Validation::validOutdoor($userOutdoor)) {
                    $_SESSION['user']->setOutDoorInterests($userOutdoor);
                } else {
                    $this->_f3->set('errors["outdoor"]', "Please enter a valid interest");
                }
                if (empty($this->_f3->get('errors'))) {
                    header('location: summary');
                }
            }

            //Get both interest and then send them to the view
            $this->_f3->set('indoor', DataLayer::getIndoors());
            $this->_f3->set('outdoor', DataLayer::getOutdoors());

            //Store the user input in the hive (Part of making the code sticky)
            $this->_f3->set('userIndoor', $userIndoor);
            $this->_f3->set('userOutdoor', $userOutdoor);

            // Display the Interest page
            $view = new Template();
            echo $view->render('views/Interest.html');
        } else {
            header('location: summary');
        }

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