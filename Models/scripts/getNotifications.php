<?php
require_once("../MessagingInterface.php");

$userID = $_POST['userID'];

$output = MessagingInterface::getUnreadMessageCount($userID);

$processedOutput = [];
foreach($output as $pendingMessages) //iterate through outputs to rename COUNT(messageID) column
{
    $temp = [];
    $temp['senderID'] = $pendingMessages['senderID'];
    $temp['messageCount'] = $pendingMessages['COUNT(messageID)'];
    array_push($processedOutput,$temp);
}

echo json_encode($processedOutput); //js script does not need processed output

?>