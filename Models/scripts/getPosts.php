<?php
require_once('../PostGetter.php');
require_once('../Database.php');
$postGetter = new PostGetter();

$output = $postGetter->getPosts($_POST); //gets all posts matching filters

$noPosts = $_POST['noPosts']; //number of posts loaded matching current filters
$output = array_slice($output,$noPosts,20); //removes posts that are already displayed and returns 20 new ones

echo json_encode($output);

?>