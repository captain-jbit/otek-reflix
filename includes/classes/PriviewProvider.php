<?php


class PreviewProvider{

    private $con;
    private $userName;

public function __construct($con,$userName){
    $this->con =$con;
    $this->userName=$userName;

}

#main video cover player
public function createPreviewVideo($entity){
    if($entity ==null){
        $entity = $this->getRandomEntity();
    }

    $id =$entity ->getId();
    $name =  $entity ->getName();
    $thumbnail =  $entity ->getThumbnail();
    $preview =  $entity ->getPreview();

    return "<div class='previewContainer'> 
    
    <img src='$thumbnail' class='previewImage' hidden>

    <video autoplay muted class='previewVideo'>
    
    <source src='$preview' type='video/mp4'>
    <video/>
    
    </div>";



}

private function getRandomEntity(){
    $query=$this->con->prepare("SELECT * FROM entities ORDER BY RAND() LIMIT 1");
    $query->execute();

    
    $row= $query->fetch(PDO::FETCH_ASSOC);#get data and store in assositive array
    
    return new Entity($this->con,$row);
}
}
?>
