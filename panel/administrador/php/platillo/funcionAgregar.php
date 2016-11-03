<?php
	$cont = intval($_COOKIE['contador']); //numero de platillos a agregar sacado de la cookie
	$nombre=$_POST['nombre'];             // nombre es el name puento en el input en la hoja de agregar.php
	$descipcion=$_POST['descripcion'];      // descripcion es el name puento en el input en la hoja de agregar.php
	$precio=$_POST['precio'];              // precio es el name puento en el input en la hoja de agregar.php
    $categoria=$_POST['categoria'];

	include ('../conexion.php');           // se importa la hoja de conexion
	$con = new Conexion('datosServer.php');// se  declara el objeto de conexion
    echo "funcion agregar    --- ";

    // se escribe la consulta con los datos obtenidos del post
	$sql = "INSERT INTO platillo (nombre, descripcion,precio,categoria, Estado) VALUES('".$nombre."','".$descipcion."',".$precio.",'".$categoria."', 'activo')";
	$con = $con->conectar();
    $result = $con->query($sql);  // se ejecuta la sentencia
    if($con->affected_rows){

            // se consulta el id con el que se insertaron los datos de combo
            $sql = "SELECT * FROM platillo WHERE Estado='activo' AND Url=''"; //consultar id del combo insertado
            $result = $con->query($sql);
            if ($result->num_rows > 0) {
                $row=$result->fetch_assoc();
                $id_Plat=$row['id_Plat'];


                // esta parte es para insertar la relacion de platillos
                // aqui se usan los name que se pusieron en la funcion listarPlatillo
                // se les concatena un contador igual que cuando se delararon
                for($i=1;$i<=$cont;$i++)  
                {
                    $sql="INSERT INTO r_pl_in (id_Plat,id_Inv,cant) VALUES (".$id_Plat.",".$_POST['id_Inv'.$i].",".$_POST['cant_'.$i].")";
                    $result = $con->query($sql);
                }

                // SE MUEVE LA IMAGEN A LA RUTA EN LA QUE QUEDARA, PRIMERO SE DEBE SALIR DE LA CARPETA ACTUAL
                // SE LE CONCATENA EL ID DEL COMBO AL QUE PERTENECE
                $ruta_final="../../../../img/platillo/platillo_".$id_Plat.".jpg";
                move_uploaded_file($_FILES["url"]["tmp_name"], $ruta_final);
                
                // SE INSERTA LA RUTA GLOBAL DE DONDE QUEDARA LA IMAGEN
                $ruta_final="img/platillo/platillo_".$id_Plat.".jpg";
                $sql = "UPDATE platillo SET Url='".$ruta_final."' WHERE id_Plat='".$id_Plat."'";
                $result = $con->query($sql);
                if($con->affected_rows){
				    $con->close();
                    echo "Combo creado con exito!!";
                }
            }
        }      
        //-----------------------


	
?>