<?php 

class EntityProvider{



    public static function getEntities($con,$categoryId,$limit){
        
        $sql ="SELECT * FROM categories ";

        if($categoryId != null) {

            $sql .="WHERE categoryID=:categoryId ";
        }

        $sql .= "ORDER BY RAND() LIMIT :limit";

        $query = $con ->prepare($sql);

        if($categoryId != null){
            $query -> bindValue(":categoryId",$categoryId);
        }

        $query->bindValue(":categoryId",$categoryId,PDO::PARAM_INT);
        $query->exucute();

        $result =array();

        while($row =$query->fetch(PDO::FETCH_ASSOC)){
            $result[]=new Entity($con, $row);

        }
        return $result;
    }

}
?>
