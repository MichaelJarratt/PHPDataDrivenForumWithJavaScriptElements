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
}

MessagingInterface::$database = Database::getInstance(); //equivalent of constructor for static field

?>