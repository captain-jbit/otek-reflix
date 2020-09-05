<?php


class SeasonProvider{
    private $con;
    private $userName;

public function __construct($con,$userName){
    $this->con =$con;
    $this->userName=$userName;

} 

public function create($entity){
$seasons = $entity->getSeasons();

if(sizeof($seasons)==0){
    return;
}
$seasonHtml = "";

foreach($seasons as $season){
    $seasonNumber= $season->getSeasonNumber();

    $videoHtml ="";

    foreach($season->getVideos() as $video){
        $videoHtml .= $this->createVideoSquare($video);
    }

    $seasonHtml .="<div class='season'>
    <h3>Season $seasonNumber</h3>
    <div class ='videos'>$videoHtml</div>
    </div>";


        }
        return $seasonHtml;
    }
    private function createVideoSquare($video){
        $id = $video->getId();
        $thumbnail = $video->getThumbnail();
        $name = $video->getTitle();
        $description = $video->getDescription();
        $episodeNumber = $video->getEpisodeNumber();
    
    return "<a href ='watch.php?id=$id'>
    
    <div class='episodeContainer'>
    
    <div class='contents'>
    <img src ='$thumbnail'>
    <div class='videoInfo'>
    <h5>$name</h5>
    <span> $episodeNumber . $description </span>
    </div>
    </div>
    </div>
    
    </a>";
    }
}
?>
