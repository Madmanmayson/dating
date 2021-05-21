<?php

ini_set('error_reporting', 1);
error_reporting(E_ALL);

//Require autoload
require_once 'vendor/autoload.php';

//Instantiate Fat-Free
$core = Base::instance();

session_start();

//Define Routes
$core->route('GET /', function(){
    $view = new Template();
    echo $view->render('views/home.html');
});

$core->route('GET|POST /signup1', function($f3){

    if(empty($_SESSION)){
        $_SESSION = array();
        $_SESSION['profile'] = new Profile();
    }

    //If the form has been submitted, add the data to session
    //and send the user to the next order form
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if(Validation::validPartialName($_POST['fname'])){
            $_SESSION['profile']->setFname($_POST['fname']);
        }
        else {
            $f3->set('errors["fname"]', 'Please enter a valid first name.');
        }

        if(Validation::validPartialName($_POST['lname'])){
            $_SESSION['profile']->setLname($_POST['lname']);
        }
        else {
            $f3->set('errors["lname"]', 'Please enter a valid last name.');
        }


        if(!empty($_POST['age']) && Validation::validAge($_POST['age'])){
            $_SESSION['profile']->setAge($_POST['age']);
        }
        else {
            $f3->set('errors["age"]', 'Please enter a valid age.');
        }

        if(Validation::validPhone($_POST['phone'])){
            $_SESSION['profile']->setPhone($_POST['phone']);
        }
        else {
            $f3->set('errors["phone"]', 'Please enter a phone number.');
        }

        // TODO: Validate optional fields
        if(!empty($_POST['gender'])){
            $_SESSION['profile']->setGender($_POST['gender']);
        }

        if(empty($f3->get('errors'))){
            header('location: signup2');
        }
    }

    $f3->set('genders', DataLayer::getGenders());

    $view = new Template();
    echo $view->render('views/personalInfo.html');
});

$core->route('GET|POST /signup2', function($f3){

    //If the form has been submitted, add the data to session
    //and send the user to the next order form
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if(!empty($_POST['email']) && Validation::validEmail($_POST['email'])){
            $_SESSION['profile']->setEmail($_POST['email']);
        }
        else {
            $f3->set('errors["email"]', 'Please enter a valid email.');
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


        if(empty($f3->get('errors'))){
            header('location: signup3');
        }

    }

    $f3->set('genders', DataLayer::getGenders());
    $f3->set('states', DataLayer::getStates());

    $view = new Template();
    echo $view->render('views/profile.html');
});

$core->route('GET|POST /signup3', function($f3){

    //If the form has been submitted, add the data to session
    //and send the user to the next order form
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if(!empty($_POST['indoor'])){
            if(Validation::validIndoor($_POST['indoor'])) {
                $_SESSION['profile']->setIndoorInterests($_POST['indoor']);
            }
            else {
                $f3->set('errors["indoor"]', 'Please give only valid indoor interests.');
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
                $f3->set('errors["indoor"]', 'Please give only valid outdoor interests.');
            }
        }
        else {
            $_SESSION['profile']->setOutdoorInterests(array());
        }


        if(empty($f3->get('errors'))){
            header('location: summary');
        }
    }

    $f3->set('indoorActivities', DataLayer::getIndoorInterests());
    $f3->set('outdoorActivities', DataLayer::getOutdoorInterests());

    $view = new Template();
    echo $view->render('views/interests.html');
});

$core->route('GET|POST /summary', function(){

    $view = new Template();
    echo $view->render('views/summary.html');
});

$core->run();