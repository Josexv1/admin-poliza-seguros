<?php
$query = "  SELECT  
codigo,
                    nombre,
                     costo,
                     estatus,
                    cobertura                 
            FROM    tipopolizas  where estatus!='Inactivo' ORDER BY codigo ASC
         ";
    try{
        $stmt = $db->prepare($query);
        $result = $stmt->execute();
    }
    catch(PDOException $ex){
    echo "Error > " .$ex->getMessage();
    }
    $rows = $stmt->fetchAll();
?>
