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

$core->route('GET|POST /signup1', function(){

    //If the form has been submitted, add the data to session
    //and send the user to the next order form
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_SESSION['fname'] = $_POST['fname'];
        $_SESSION['lname'] = $_POST['lname'];
        $_SESSION['age'] = $_POST['age'];
        $_SESSION['gender'] = $_POST['gender'];
        $_SESSION['phone'] = $_POST['phone'];
        header('location: signup2');
    }

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
        $_SESSION['indoor'] = $_POST['indoor'];
        $_SESSION['outdoor'] = $_POST['outdoor'];
        header('location: summary');
    }

    $view = new Template();
    echo $view->render('views/interests.html');
});

$core->route('GET|POST /summary', function(){

    var_dump($_SESSION);
});

$core->run();