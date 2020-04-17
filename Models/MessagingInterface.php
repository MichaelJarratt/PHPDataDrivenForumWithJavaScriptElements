<?php
/*
 * this class handles interfacing with the database in respects to anything to do with messaging
 */

require_once("Database.php");

class MessagingInterface
{
    public static $database;

    /*
     * returns tuples of contacts associated with userID
     *
     * query explanation:
     * selects details of user that are contacts of "userID"
     * finds contacts of "userID" in column 1 and contacts of "userID" in column 2 then joins them via union
     */
    public static function getContacts($userID)
    {
        return self::$database->retrieve("SELECT userID, username FROM Users WHERE userID IN (SELECT col1 FROM MessageContacts WHERE col2 = \"$userID\" UNION SELECT col2 FROM MessageContacts WHERE col1 = \"$userID\")");
    }

    /*
     * gets every message sent between userID and targetUserID whos messageID is greater than latestMessageID
     */
    public static function getMessages($userID,$targetUserID,$latestMessageID)
    {
        return self::$database->retrieve("SELECT messageID,senderID, message,timeSent,received,recipientID FROM Messages WHERE messageID > \"$latestMessageID\" AND ((senderID = \"$userID\" AND recipientID=\"$targetUserID\") OR (senderID = \"$targetUserID\" AND recipientID=\"$userID\"))");
    }

    /*
     * sets a message (by ID) as having been received
     */
    public static function setReceived($messageID)
    {
        self::$database->update("UPDATE Messages set received = 1 WHERE messageID = \"$messageID\";");
    }

    /*
     * inserts new message into database
     */
    public static function insertMessage($senderID,$recipientID,$message)
    {
        self::$database->update("INSERT INTO Messages(senderID, recipientID, message) VALUES(\"$senderID\",\"$recipientID\",\"$message\")");
    }

    /*
     * selects the userID of the sender and the number of unread messages sent to current user
     * no senderIDs are selected if there are no unread messages for current user
     */
    public static function getUnreadMessageCount($userID)
    {
        return self::$database->retrieve("SELECT senderID, COUNT(messageID) FROM Messages WHERE recipientID = \"$userID\" AND received = 0 GROUP BY senderID");
    }
}

MessagingInterface::$database = Database::getInstance(); //equivalent of constructor for static field

?>