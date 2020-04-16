<?php
session_start();
if(!isset($_SESSION['userID'])) //catches out people who are not logged in and sends them to login page
{
    header("location: login.php");
}

require("Models/MessagingInterface.php"); //class to interface with database

$view = new stdClass(); //generic class to hold information to be passed to view
$view->contacts = MessagingInterface::getContacts($_SESSION['userID']);
//var_dump($view->contacts);

require_once("Views/messaging.phtml");

?>
