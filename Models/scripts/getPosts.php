<?php
require_once('../PostGetter.php');
require_once('../Database.php');
$postGetter = new PostGetter();

$output = $postGetter->getPosts($_POST); //gets all posts matching filters

$noPosts = $_POST['noPosts']; //number of posts loaded matching current filters
$output = array_slice($output,$noPosts,20); //removes posts that are already displayed and returns 20 new ones

//cuts title and content preview down to appropriate length for index page
foreach($output as &$post)
{
    if(strlen($post["title"])>80)
    {
        $post["title"] = substr($post["title"],0,77)."..."; //if title is longer than 80 characters display 77 characets and "..."
    }
    if(strlen($post["content"])>200)
    {
        $post["content"] = substr($post["content"],0,197)."..."; //if content is longer than 200 characters display 197 characets and "..."
    }
}

echo json_encode($output);

?>