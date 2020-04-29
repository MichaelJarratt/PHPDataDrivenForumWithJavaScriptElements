<?php
require_once("../MessagingInterface.php");
// temporary file, create a more appropriate name, such as sendImage.php

//var_dump($_FILES['image']);

$image = $_FILES['image'];
$noImages = MessagingInterface::getNumberOfImages();
$extension = pathinfo($image['name'])['extension']; //gets file extension from name
$filename = "image".($noImages+1).".".$extension; //creates new file name from incremented number and extension
$originalName = $image['name'];

move_uploaded_file($image['tmp_name'],"../../images/".$filename);


MessagingInterface::insertImageMessage($_POST['userID'],$_POST['targetUserID'],$filename,$originalName);

var_dump($_POST);
?>