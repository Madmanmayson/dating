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

$core->route('GET|POST /signup2', function(){

    //If the form has been submitted, add the data to session
    //and send the user to the next order form
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['state'] = $_POST['state'];
        $_SESSION['seeking'] = $_POST['seeking'];
        $_SESSION['bio'] = $_POST['bio'];
        header('location: signup3');
    }

    $view = new Template();
    echo $view->render('views/profile.html');
});

$core->route('GET|POST /signup3', function(){

    //If the form has been submitted, add the data to session
    //and send the user to the next order form
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_SESSION['indoor'] = implode(", ", $_POST['indoor']);
        $_SESSION['outdoor'] = implode(", ", $_POST['outdoor']);
        header('location: summary');
    }

    $view = new Template();
    echo $view->render('views/interests.html');
});

$core->route('GET|POST /summary', function(){

    $view = new Template();
    echo $view->render('views/summary.html');
});

$core->run();