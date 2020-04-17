<?php
require_once("../MessagingInterface.php");

$userID = $_POST['userID'];
$targetUserID = $_POST['targetUserID'];
$message = $_POST['message'];

MessagingInterface::insertMessage($userID,$targetUserID,$message);

?>