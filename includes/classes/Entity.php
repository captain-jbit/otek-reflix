<?php

class Entity {

    private $con,$sqlData;#$input = entity id or data from db

    public function __construct($con,$input)
    {
    $this->con=$con;

    if(is_array($input)){
        $this->sqlData =$input;
    }
    else{
        $query = $this ->con->prepare("SELECT * FROM entities WHERE id=:id");
        $query->bindValue(":id",$input);
        $query->execute();

        $this->input = $query->fetch(Pdo::FETCH_ASSOC);
    }
    
    }

    public function getId(){
        return $this->sqlData["id"];
    }
    public function getName(){
        return $this->sqlData["name"];
    }
    public function getThumbnail(){
        return $this->sqlData["thumbnail"];
    }
    public function getPreview(){
        return $this->sqlData["preview"];
    }
}


?>
