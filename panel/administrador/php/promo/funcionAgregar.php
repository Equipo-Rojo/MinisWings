<?php
	$cont = intval($_COOKIE['contador']); //numero de platillos a agregar sacado de la cookie
	$nombre=$_POST['nombre'];             // nombre es el name puento en el input en la hoja de agregar.php
	$descipcion=$_POST['descripcion'];      // descripcion es el name puento en el input en la hoja de agregar.php
	$precio=$_POST['precio'];              // precio es el name puento en el input en la hoja de agregar.php
	$fecha=$_POST['fecha'];
	include ('../conexion.php');           // se importa la hoja de conexion
	$con = new Conexion('datosServer.php');// se  declara el objeto de conexion


    // se escribe la consulta con los datos obtenidos del post
	$sql = "INSERT INTO promos (nombre, descripcion,precio,fecha,Estado) VALUES('".$nombre."','".$descipcion."',".$precio.",'".$fecha."','activo')";
	$con = $con->conectar();
    $result = $con->query($sql);  // se ejecuta la sentencia
    if($con->affected_rows){

            // se consulta el id con el que se insertaron los datos de promo
            $sql = "SELECT * FROM promos WHERE Estado='activo' AND Url=''"; //consultar id del promo insertado
            $result = $con->query($sql);
            if ($result->num_rows > 0) {
                $row=$result->fetch_assoc();
                $id_Promo=$row['id_Promo'];


                // esta parte es para insertar la relacion de platillos
                // aqui se usan los name que se pusieron en la funcion listarPlatillo
                // se les concatena un contador igual que cuando se delararon
                for($i=1;$i<=$cont;$i++)  
                {
                    $sql="INSERT INTO r_pr_pl (id_Prom,id_Plat,cant) VALUES (".$id_Promo.",".$_POST['id_Plat'.$i].",".$_POST['cant_'.$i].")";
         
                    $result = $con->query($sql);
                }

                // SE MUEVE LA IMAGEN A LA RUTA EN LA QUE QUEDARA, PRIMERO SE DEBE SALIR DE LA CARPETA ACTUAL
                // SE LE CONCATENA EL ID DEL PROMO AL QUE PERTENECE
                $ruta_final="../../../../img/promo/promo_".$id_Promo.".jpg";
                move_uploaded_file($_FILES["url"]["tmp_name"], $ruta_final);
                
                // SE INSERTA LA RUTA GLOBAL DE DONDE QUEDARA LA IMAGEN
                $ruta_final="img/promo/promo_".$id_Promo.".jpg";
                $sql = "UPDATE promos SET Url='".$ruta_final."' WHERE id_Promo='".$id_Promo."'";
                $result = $con->query($sql);
                if($con->affected_rows){
				    $con->close();
                    echo "Promoción creada con exito!!";
                }
            }
        }      
        //-----------------------


	
?>