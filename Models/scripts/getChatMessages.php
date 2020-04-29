<?php
/*
 * script called from messaging.phtml and is responsible for retrieving messages
 */


require_once("../MessagingInterface.php");

$userID = $_POST['userID'];
$targetUserID = $_POST['targetUserID'];
$latestMessageID = $_POST['latestMessageID'];

$output = MessagingInterface::getMessages($userID,$targetUserID,$latestMessageID); //gets array of message tuples

foreach($output as &$message) //& allows message to be updated, allowing images to be inserted if present
{
    if($message['received']=='0' && $message['recipientID']==$userID) //if message has not been marked as read and the current user has now received it
    {
        MessagingInterface::setReceived($message['messageID']);
    }

    if(MessagingInterface::hasImage($message['messageID'])) //if the message has an associated image
    {
        $imageData = MessagingInterface::getImage($message['messageID']); //gets image data for this message
        $message['fileName'] = $imageData['fileName'];
        $message['originalName'] = $imageData['originalName'];
    }
}

echo json_encode($output); //encodes array of message tuples into JSON and returns it to JS script

?>