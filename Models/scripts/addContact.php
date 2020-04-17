<?php
/*
 * this script is called by "addContacts()" method in userPage.phtml, it uses the database class to make an
 * association between two userIDs which is then used to populate a users contacts list in the messaging page.
 * It also creates the relevant entries in the TypingStatus table, allowing users to see when their chat
 * counterpart is typing.
 */
require_once("../Database.php"); //relative path

$userID = $_POST['userID'];
$targetUserID = $_POST['targetUserID'];

//adds contact
Database::getInstance()->update("INSERT INTO MessageContacts VALUES(\"$userID\",\"$targetUserID\")");
//generates warning about column names but still works fine

//makes typing status entries
Database::getInstance()->update("INSERT INTO TypingStatus(senderID, recipientID) VALUES(\"$userID\",\"$targetUserID\")");
Database::getInstance()->update("INSERT INTO TypingStatus(senderID, recipientID) VALUES(\"$targetUserID\",\"$userID\")");

?>
