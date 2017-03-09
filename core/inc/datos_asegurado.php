<?php
//EL QUERY HACE LA CONSULTA DE LOS ASEGURADOS DONDE EL ESTATUS SEA ACTIVO
//EL ESTATUS ACTIVO NOS VALIDA QUE SOLO SE IMPRIMAN LOS USUARIOS QUE NO TENGAN ESE ESTATUS
//ACTIVO NOS INDICA QUE EL USUARIO NO FUE ELIMINADO Y QUE SE ESTAN USANDO SUS DATOS
//INACTIVO NOS INDICA QUE EL USUARIO FUE ELIMINADO DE MANERA LOGICA
$query = "  SELECT * FROM asegurado where estatus!='Inactivo' ";
//LA FUNCION TRY,CARTCH NOS CARTURA ERRORRES
    try{
        //AQUI SE EJECUTA EL QUERY MEDIANTE LA FUNCION PREPARE()
        
        $stmt = $db->prepare($query);
        $result = $stmt->execute();
    }
    catch(PDOException $ex){
        //EL ECHO NOS IMPRIME MENSAJES
        //EL $EX->GETMENSAGE NOS PUESTRA EL TIPO DE ERROR POR EL CUAL FALLO LA CONSULTA DEL QUERY
    echo "Error > " .$ex->getMessage();
    }
    $rows = $stmt->fetchAll();

?>
