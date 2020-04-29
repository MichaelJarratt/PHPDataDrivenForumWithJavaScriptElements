<?php
require_once("../MessagingInterface.php");

$image = $_FILES['image']; //gets image from files global variable
$extension = pathinfo($image['name'])['extension']; //gets file extension from name
$noImages = MessagingInterface::getNumberOfImages(); //number of images already existing (used to name them without conflicts)
$filename = "image".($noImages+1).".".$extension; //creates new file name from incremented number and extension
$originalName = $image['name']; //the original name of the file

//no need to check images before saving them because it will have been checked by the javascript
move_uploaded_file($image['tmp_name'],"../../images/".$filename); //moves file to permanent location under new name

MessagingInterface::insertImageMessage($_POST['userID'],$_POST['targetUserID'],$filename,$originalName); //records image in database

?>