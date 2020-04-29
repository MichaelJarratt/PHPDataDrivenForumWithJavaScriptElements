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
        $message = addslashes($message); //escapes any characters that need escaping
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

    /*
     * returns how many images exist in the database so the correct incremental name can be chosen
     */
    public static function getNumberOfImages()
    {
        return self::$database->retrieve("SELECT COUNT(*) FROM MessageImages")[0]['COUNT(*)'];
    }

    /*
     *  create entry in MessageImages associating uploaded image with its message
     */
    public static function insertImageMessage($senderID,$recipientID,$fileName,$originalName)
    {
        //selects ID of latest message sent by user
        $latestMessageID = self::$database->retrieve("SELECT messageID FROM Messages WHERE senderID=\"$senderID\" and recipientID=\"$recipientID\" ORDER BY messageID DESC LIMIT 1")[0]['messageID'];
        self::$database->update("INSERT INTO MessageImages(messageID, fileName, originalName) VALUES (\"$latestMessageID\",\"$fileName\",\"$originalName\")");
    }

    /*
     * returns true or false if a message of messageID has an associated image
     */
    public static function hasImage($messageID)
    {
        $output = self::$database->retrieve("SELECT imageID FROM MessageImages WHERE messageID=\"$messageID\"");
        if(sizeof($output) == 0)
        { //if message has no associated image
            return false;
        }
        else
        { //if message does have an associated image
            return true;
        }
    }

    /*
     * takes messageID as a parameter and returns a tuple containing it's associated image and it's original name
     */
    public static function getImage($messageID)
    {
        return self::$database->retrieve("SELECT fileName,originalName FROM MessageImages WHERE messageID = \"$messageID\"")[0];
    }
}

MessagingInterface::$database = Database::getInstance(); //equivalent of constructor for static field

?>