<?php
require_once("../MessagingInterface.php");
// temporary file, create a more appropriate name, such as sendImage.php

//var_dump($_FILES['image']);

$image = $_FILES['image'];
$noImages = MessagingInterface::getNumberOfImages();
$extension = pathinfo($image['name'])['extension']; //gets file extension from name

move_uploaded_file($image['tmp_name'],"../../images/image".($noImages+1).".".$extension);
echo $extension;
?>