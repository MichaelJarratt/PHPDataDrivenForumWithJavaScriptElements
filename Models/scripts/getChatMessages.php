<?php
/*
 * script called from messaging.phtml and is responsible for retrieving messages
 */


require_once("../MessagingInterface.php");

$userID = $_POST['userID'];
$targetUserID = $_POST['targetUserID'];
$latestMessageID = $_POST['latestMessageID'];

$output = MessagingInterface::getMessages($userID,$targetUserID,$latestMessageID); //gets array of message tuples

foreach($output as $message)
{
    if($message['received']=='0' && $message['recipientID']==$userID) //if message has not been marked as read and the current user has now received it
    {
        MessagingInterface::setReceived($message['messageID']);
    }
}

echo json_encode($output); //encodes array of message tuples into JSON and returns it to JS script

?>