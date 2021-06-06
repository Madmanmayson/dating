<?php

ini_set('error_reporting', 1);
error_reporting(E_ALL);

//Require autoload
require_once 'vendor/autoload.php';

//Instantiate Fat-Free
$core = Base::instance();
$controller = new Controller($core);

session_start();

//Define Routes
$core->route('GET /', function(){
    $GLOBALS['controller']->home();
});

$core->route('GET|POST /signup1', function($f3){
    $GLOBALS['controller']->signup1();
});

$core->route('GET|POST /signup2', function($f3){
    $GLOBALS['controller']->signup2();
});

$core->route('GET|POST /signup3', function($f3){
    $GLOBALS['controller']->signup3();
});

$core->route('GET|POST /summary', function(){
    $GLOBALS['controller']->summary();
});

$core->run();