<?php
//script called when users typing status needs to be changed, simply updates the database with the current status
require_once("../Database.php");

$userID = $_POST['userID']; //sender
$targetUserID = $_POST['targetUserID']; //recipient
$status = $_POST['status']; // 0 = not typing, 1 = typing

Database::getInstance()->update("UPDATE TypingStatus set status = \"$status\" WHERE senderID = \"$userID\" AND recipientID = \"$targetUserID\"");

?>