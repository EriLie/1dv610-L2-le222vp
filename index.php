<?php

//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('view/RegisterView.php');
require_once('settings.php');


//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');



session_start();

//CREATE OBJECTS OF THE VIEWS
$v = new LoginView();
$dtv = new DateTimeView();
$lv = new LayoutView();
$regV = new RegisterView();


//Connect with database
/*$config = include('settings.php');
$connect = mysqli_connect($config->host, $config->username, $config->password, $config->database);
*/
if (isset($_SESSION['userLoggedIn'])) {
    
    $lv->render(true, $v, $dtv, $regV);

} else {
    $lv->render(false, $v, $dtv, $regV);
}

//$_SESSION['userLoggedIn'];






//$regV->print();

//$lv->render(false, $v, $dtv, $regV);

