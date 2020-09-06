<?php

require_once("includes/header.php");


#check if user logged in by session
if(!isset($_SESSION["userLoggedIn"])){
    header("Location: register.php");
}

$video = new Video($con,$_GET["id"]);
$video->incrementViews();


?>

<div class="watchContainer">

<div class="videoControls watchNav"> 
    <button onclick="goBack()"><i class="fas fa-arrow-left"></i></button>
    <h1><?php echo $video->getTitle();?></h1>
</div>

<div class="videoControls upNext">
<button><i class="fas fa-redo"></button>
</div>

<video conttrols autoplay>
    <source src='<?php echo $video->getFilePath();?>' type="video/mp4"/>
</video>

</div>

<script>initVideo("<?php echo $video->getId(); ?>","<?php echo $userLoggedIn?>");</script>
