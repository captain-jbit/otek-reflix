<?php

require_once("includes/header.php");


#check if user logged in by session
if(!isset($_SESSION["userLoggedIn"])){
    header("Location: register.php");
}

$video = new Video($con,$_GET["id"]);
$video->incrementViews();

$upNextVideo = VideoProvider::getUpNext($con,$video);
?>

<div class="watchContainer">

<div class="videoControls watchNav"> 
    <button onclick="goBack()"><i class="fas fa-arrow-left"></i></button>
    <h1><?php echo $video->getTitle();?></h1>
</div>

<div class="videoControls upNext">
<button onclick="restartVideo();"><i class="fas fa-redo"></i></button>
2
<div class ="upNextContainer"> 
    <h2>Up next:</h2>
    <h3><?php echo $upNextVideo->getTitle();?></h3>
    <h3><?php echo $upNextVideo->getSeasonNumber();?></h3>
    <button class="playNext"><i class="fas fa-arrow-left"></i></button>
</div>

<video conttrols autoplay>
    <source src='<?php echo $video->getFilePath();?>' type="video/mp4"/>
</video>

</div>

<script>initVideo("<?php echo $video->getId(); ?>","<?php echo $userLoggedIn?>");</script>
