<?php
require_once("../MessagingInterface.php");

$image = $_FILES['image']; //gets image from files global variable
$extension = pathinfo($image['name'])['extension']; //gets file extension from name
$noImages = MessagingInterface::getNumberOfImages(); //number of images already existing (used to name them without conflicts)

//no need to check images before saving them because it will have been checked by the javascript
move_uploaded_file($image['tmp_name'],"../../images/image".($noImages+1).".".$extension); //increments image number and saves it in Images



?>