<?php

require_once("includes/header.php");


#check if user logged in by session
if(!isset($_SESSION["userLoggedIn"])){
    header("Location: register.php");
}

$video = new Video($con,$_GET["id"]);
$videos->incrementViews();

?>

<div class="watchContainer">


<video conttrols autoplay>
    <source src='<?php echo $video->getFilePath();?>' type="video/mp4"/>
</video>
</div>

