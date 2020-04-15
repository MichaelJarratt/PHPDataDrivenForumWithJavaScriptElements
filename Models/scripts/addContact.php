<?php
/*
 * this script is called by "addContacts()" method in userPage.phtml, it uses the database class to make an
 * association between two userIDs which is then used to populate a users contacts list in the messaging page
 */
require_once("../Database.php"); //relative path

$userID = $_POST['userID'];
$targetUserID = $_POST['targetUserID'];

Database::getInstance()->update("INSERT INTO MessageContacts VALUES(\"$userID\",\"$targetUserID\")");
//generates warning about column names but still works fine


?>
