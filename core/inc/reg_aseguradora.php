<?php

if (!defined('SRCP')) {
    die('Logged Hacking attempt!');
}
    //comienzo del registro de los corredor.
    if (!empty($_POST)) {

        $query = '  SELECT 1
            		FROM aseguradora
            		WHERE rif = :rif
        		  ';
        $query_params = array(':rif' => $_POST['rif']);
        try {
            $stmt = $db->prepare($query);
            $result = $stmt->execute($query_params);
        } catch (PDOException $ex) {
            /*
        	  TODO: Aqui de igual forma cambiaremos a un modal
        	 */
            die('Fallamos al hacer la busqueda: '.$ex->getMessage());
        }
        $row = $stmt->fetch();
        if ($row) {
            echo "<div class='panel-body'>
                <div class='alert alert-warning alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                Error: La cédula ya existe.</div>
            </div>";
        }
        $query = 'SELECT 1
            	  FROM aseguradora
            	  WHERE rif = :rif
        		 ';
        $query_params = array(
            ':correo' => $_POST['correo'],
        );
        try {
            $stmt = $db->prepare($query);
            $result = $stmt->execute($query_params);
        } catch (PDOException $ex) {
            die('Fallamos al revisar el email.: '.$ex->getMessage());
        }
        $row = $stmt->fetch();
        if ($row) {
            echo "<div class='panel-body'>
                <div class='alert alert-warning alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                Error: El correo ya esta en uso.</div>
            </div>";
        }

        /// Si todo pasa enviamos los datos a la base de datos mediante PDO para evitar Inyecciones SQL
        $query = '	INSERT INTO aseguradora (
				                rif,
                                cuentabancaria,
                                cedulacuentabancaria,
                                nombre,
                                direccion,
                                telefonolocal,
                                telefonopersonal,
                                correo,
                                estatus,
                                estado,
                                fechafundacion
				    ) VALUES (
                                :rif,
                                :cuentabancaria,
                                :cedulacuentabancaria,
                                :nombre,
                                :direccion,
                                :telefonolocal,
                                :telefonopersonal,
                                :correo,
                                :estatus,
                                :estado,
                                :fechafundacion
				            )
        		';
        $query_params = array(
            ':rif' => $_POST['rif'],
            ':cuentabancaria' => $_POST['cuentabancaria'],
            ':cedulacuentabancaria' => $_POST['cedulacuentabancaria'],
            ':nombre' => $_POST['nombres'],
            ':direccion' => $_POST['direccion'],
            ':telefonolocal' => $_POST['telefonolocal'],
            ':telefonopersonal' => $_POST['telefonopersonal'],
            ':correo' => $_POST['correo'],
            ':estatus' => $_POST['estatus'],
            ':estado' => $_POST['estado'],
            ':fechafundacion' => $_POST['fechafundacion'],
           
            );

        try {
            $stmt = $db->prepare($query);
            $result = $stmt->execute($query_params);
        } catch (PDOException $ex) {
            // Si tenemos problemas para ejecutar la consulta imprimimos el error
            echo "<div class='panel-body'>
                     <div class='alert alert-warning alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        Tenemos problemas al ejecutar la consulta :c El error es el siguiente:
					</div>
				  </div>".$ex->getMessage();
        }
        header('Location: index.php?do=listacorredores');
    }

    if (isset($_GET['accion'])) {

    //check the action
    switch ($_GET['accion']) {
        case 'error':
            echo "<div class='panel-body'>
                    <div class='alert alert-success alert-dismissable'>
                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                      Hay varios errores en tu registro.
                      Si necesitas ayuda puedes hacer clic al botón de Ayuda en el fondo de la página.
					</div>
				</div>";
            break;
    }
    }