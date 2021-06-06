<?php

class Controller
{
    private $_f3;

    /**
     * controller constructor.
     * @param $_f3
     */
    public function __construct($_f3)
    {
        $this->_f3 = $_f3;
    }

    function home()
    {
        $view = new Template();
        echo $view->render('views/home.html');
    }

    function signup1()
    {
        if(empty($_SESSION)){
            $_SESSION = array();
            $_SESSION['profile'] = new Member(); //Needed for GET due to validation code
        }


        //If the form has been submitted, add the data to session
        //and send the user to the next order form
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if(isset($_POST['premium'])){
                $_SESSION['profile'] = new PremiumMember();
            }
            else {
                $_SESSION['profile'] = new Member();
            }

            // fname
            $_SESSION['profile']->setFname($_POST['fname']);
            if(!Validation::validPartialName($_POST['fname'])){
                $this->_f3->set('errors["fname"]', 'Please enter a valid first name.');
            }

            // lname
            $_SESSION['profile']->setLname($_POST['lname']);
            if(!Validation::validPartialName($_POST['lname'])){
                $this->_f3->set('errors["lname"]', 'Please enter a valid last name.');
            }

            // age
            if(!empty($_POST['age'])){
                $_SESSION['profile']->setAge($_POST['age']);
                if(!Validation::validAge($_POST['age'])){
                    $this->_f3->set('errors["age"]', 'Please enter a valid age.');
                }
            }

            // phone
            $_SESSION['profile']->setPhone($_POST['phone']);
            if(!Validation::validPhone($_POST['phone'])) {
                $this->_f3->set('errors["phone"]', 'Please enter a phone number.');
            }

            // TODO: Validate optional fields
            if(!empty($_POST['gender'])){
                $_SESSION['profile']->setGender($_POST['gender']);
            }

            if(empty($this->_f3->get('errors'))){
                header('location: signup2');
            }
        }

        $this->_f3->set('genders', DataLayer::getGenders());

        $view = new Template();
        echo $view->render('views/personalInfo.html');
    }
    
    function signup2()
    {
        //If the form has been submitted, add the data to session
        //and send the user to the next order form
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // email
            $_SESSION['profile']->setEmail($_POST['email']);
            if(!empty($_POST['email'])){
                if(!Validation::validEmail($_POST['email'])){
                    $this->_f3->set('errors["email"]', 'Please enter a valid email.');
                }
            }
            else {
                $_SESSION['profile']->setEmail("");
            }


            if(!empty($_POST['state'])){
                $_SESSION['profile']->setState($_POST['state']);
            }

            if(!empty($_POST['seeking'])){
                $_SESSION['profile']->setSeekingGender($_POST['seeking']);
            }

            if(!empty($_POST['bio'])){
                $_SESSION['profile']->setBio($_POST['bio']);
            }


            if(empty($this->_f3->get('errors'))){
                if($_SESSION['profile'] instanceof PremiumMember){
                    header('location: signup3');
                }
                else {
                    header('location: summary');

                }
            }
        }

        $this->_f3->set('genders', DataLayer::getGenders());
        $this->_f3->set('states', DataLayer::getStates());

        $view = new Template();
        echo $view->render('views/profile.html');
    }
    
    function signup3(){
        //If the form has been submitted, add the data to session
        //and send the user to the next order form
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if(!empty($_POST['indoor'])){
                if(Validation::validIndoor($_POST['indoor'])) {
                    $_SESSION['profile']->setIndoorInterests($_POST['indoor']);
                }
                else {
                    $this->_f3->set('errors["indoor"]', 'Please give only valid indoor interests.');
                }
            }
            else {
                $_SESSION['profile']->setIndoorInterests(array());
            }

            if(!empty($_POST['outdoor'])){
                if(Validation::validOutdoor($_POST['outdoor'])) {
                    $_SESSION['profile']->setOutdoorInterests($_POST['outdoor']);
                }
                else {
                    $this->_f3->set('errors["indoor"]', 'Please give only valid outdoor interests.');
                }
            }
            else {
                $_SESSION['profile']->setOutdoorInterests(array());
            }


            if(empty($this->_f3->get('errors'))){
                header('location: summary');
            }
        }

        $this->_f3->set('indoorActivities', DataLayer::getIndoorInterests());
        $this->_f3->set('outdoorActivities', DataLayer::getOutdoorInterests());

        $view = new Template();
        echo $view->render('views/interests.html');
    }

    function summary(){
        $view = new Template();
        echo $view->render('views/summary.html');
    }
}