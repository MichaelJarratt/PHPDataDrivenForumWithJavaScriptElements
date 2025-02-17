CREATE DATABASE  IF NOT EXISTS `sye564_forum` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `sye564_forum`;
-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: poseidon.salford.ac.uk    Database: sye564_forum
-- ------------------------------------------------------
-- Server version	5.7.29-0ubuntu0.18.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Categories`
--

DROP TABLE IF EXISTS `Categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Categories` (
  `catID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `catName` varchar(45) NOT NULL,
  PRIMARY KEY (`catID`),
  UNIQUE KEY `catID_UNIQUE` (`catID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `CommentReplies`
--

DROP TABLE IF EXISTS `CommentReplies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `CommentReplies` (
  `parent` int(10) unsigned NOT NULL,
  `child` int(10) unsigned NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `childComment_idx` (`child`),
  CONSTRAINT `childComment` FOREIGN KEY (`child`) REFERENCES `Comments` (`commentID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `parentComment` FOREIGN KEY (`parent`) REFERENCES `Comments` (`commentID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Comments`
--

DROP TABLE IF EXISTS `Comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Comments` (
  `commentID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `commentor` int(10) unsigned NOT NULL,
  `content` varchar(500) NOT NULL,
  `likes` int(10) unsigned NOT NULL DEFAULT '0',
  `dislikes` int(10) unsigned NOT NULL DEFAULT '0',
  `archived` tinyint(4) NOT NULL DEFAULT '0',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`commentID`),
  KEY `userID_comments_idx` (`commentor`),
  CONSTRAINT `userID_comments` FOREIGN KEY (`commentor`) REFERENCES `Users` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6020 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `MessageContacts`
--

DROP TABLE IF EXISTS `MessageContacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `MessageContacts` (
  `col1` int(11) unsigned NOT NULL,
  `col2` int(11) unsigned NOT NULL,
  PRIMARY KEY (`col1`,`col2`),
  KEY `contactUserID2_idx` (`col2`),
  CONSTRAINT `contactUserID1` FOREIGN KEY (`col1`) REFERENCES `Users` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `contactUserID2` FOREIGN KEY (`col2`) REFERENCES `Users` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='very simple table for associating user IDs in a contacts list';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `MessageImages`
--

DROP TABLE IF EXISTS `MessageImages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `MessageImages` (
  `imageID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `messageID` int(11) unsigned NOT NULL,
  `fileName` text NOT NULL,
  `originalName` text NOT NULL,
  PRIMARY KEY (`imageID`),
  UNIQUE KEY `imageID_UNIQUE` (`imageID`),
  KEY `MessageImagesMessageID_idx` (`messageID`),
  CONSTRAINT `MessageImagesMessageID` FOREIGN KEY (`messageID`) REFERENCES `Messages` (`messageID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Messages`
--

DROP TABLE IF EXISTS `Messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Messages` (
  `messageID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `senderID` int(11) unsigned NOT NULL,
  `recipientID` int(11) unsigned NOT NULL,
  `message` text NOT NULL,
  `received` tinyint(4) NOT NULL DEFAULT '0',
  `timeSent` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`messageID`)
) ENGINE=InnoDB AUTO_INCREMENT=151 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `PostComments`
--

DROP TABLE IF EXISTS `PostComments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `PostComments` (
  `post` int(10) unsigned NOT NULL,
  `comment` int(10) unsigned NOT NULL,
  PRIMARY KEY (`post`,`comment`),
  KEY `postChildComment_idx` (`comment`),
  CONSTRAINT `parentPost` FOREIGN KEY (`post`) REFERENCES `Posts` (`postID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `postChildComment` FOREIGN KEY (`comment`) REFERENCES `Comments` (`commentID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `PostImages`
--

DROP TABLE IF EXISTS `PostImages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `PostImages` (
  `imageID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `postID` int(10) unsigned NOT NULL,
  `imageName` varchar(100) NOT NULL,
  PRIMARY KEY (`imageID`),
  KEY `post_idx` (`postID`),
  CONSTRAINT `post` FOREIGN KEY (`postID`) REFERENCES `Posts` (`postID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Posts`
--

DROP TABLE IF EXISTS `Posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Posts` (
  `postID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `poster` int(10) unsigned NOT NULL,
  `category` int(10) unsigned NOT NULL,
  `title` varchar(300) NOT NULL,
  `content` varchar(2000) NOT NULL,
  `datePosted` datetime NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `archived` tinyint(4) NOT NULL DEFAULT '0',
  `views` int(11) NOT NULL DEFAULT '0',
  `likes` int(11) NOT NULL DEFAULT '0',
  `dislikes` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`postID`),
  KEY `userID_idx` (`poster`),
  KEY `category_idx` (`category`),
  CONSTRAINT `category` FOREIGN KEY (`category`) REFERENCES `Categories` (`catID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `userID` FOREIGN KEY (`poster`) REFERENCES `Users` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1022 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `TypingStatus`
--

DROP TABLE IF EXISTS `TypingStatus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `TypingStatus` (
  `senderID` int(11) unsigned NOT NULL,
  `recipientID` int(11) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`senderID`,`recipientID`),
  KEY `TypingStatus_RecipientID_idx` (`recipientID`),
  CONSTRAINT `TypingStatus_RecipientID` FOREIGN KEY (`recipientID`) REFERENCES `Users` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `TypingStatus_SenderID` FOREIGN KEY (`senderID`) REFERENCES `Users` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Users` (
  `userID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userName` varchar(40) NOT NULL,
  `pwHash` varchar(200) NOT NULL,
  `dateJoined` datetime NOT NULL,
  `email` varchar(50) NOT NULL DEFAULT 'there should be an email here',
  PRIMARY KEY (`userID`),
  UNIQUE KEY `Users_userName_uindex` (`userName`),
  UNIQUE KEY `Users_email_uindex` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=350 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping events for database 'sye564_forum'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-04-30  1:42:58
