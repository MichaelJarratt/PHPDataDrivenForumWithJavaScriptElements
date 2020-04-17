<?php
//this script is responsible for returning true or false weather the target is typing a message to the current user
//this script is polled by messaging.phtml
require_once("../Database.php");

$userID = $_POST['userID']; //recipient
$targetUserID = $_POST['targetUserID']; //sender

$output = Database::getInstance()->retrieve("SELECT status FROM TypingStatus WHERE recipientID = \"$userID\" AND senderID = \"$targetUserID\"");

if($output[0]['status'] == 1) //if target is typing a message to current user
{
    echo "true";
}
else
{
    echo "false";
}

?>