<?php
	$cont = intval($_COOKIE['contador']); //numero de platillos a agregar sacado de la cookie
	$nombre=$_POST['nombre'];             // nombre es el name puento en el input en la hoja de agregar.php
	$descipcion=$_POST['descripcion'];      // descripcion es el name puento en el input en la hoja de agregar.php
	$precio=$_POST['precio'];              // precio es el name puento en el input en la hoja de agregar.php
	$id=intval($_COOKIE['promo']);
	$fecha=$_POST['fecha'];
	include ('../conexion.php');           // se importa la hoja de conexion
	$con = new Conexion('datosServer.php');// se  declara el objeto de conexion


    // se escribe la consulta con los datos obtenidos del post
	$sql = "UPDATE promos SET nombre='".$nombre."', Descripcion='".$descipcion."',Fecha='".$fecha."', precio=".$precio.",Estado='activo' WHERE id_Promo=".$id;
	$con = $con->conectar();
	
    $result = $con->query($sql);  // se ejecuta la sentencia
   

	// se eliminan los registros anteriores por si se elimino algun platillo del promo
	$sql="DELETE FROM r_pr_pl WHERE id_Prom=".$id;
    $result = $con->query($sql);
    // esta parte es para insertar la relacion de platillos
    // aqui se usan los name que se pusieron en la funcion listarPlatillo
    // se les concatena un contador igual que cuando se delararon
    for($i=1;$i<=$cont;$i++)  
    {
        $sql="INSERT INTO r_pr_pl (id_Prom,id_Plat,cant) VALUES (".$id.",".$_POST['id_Plat'.$i].",".$_POST['cant_'.$i].")";
        $result = $con->query($sql);
    }

     // SE INSERTA LA RUTA GLOBAL DE DONDE QUEDARA LA IMAGEN
    $ruta_final="img/promo/promo_".$id.".jpg";
    $sql = "UPDATE promos SET Url='".$ruta_final."' WHERE id_Promo='".$id."'";
    $result = $con->query($sql);
   
    // SE MUEVE LA IMAGEN A LA RUTA EN LA QUE QUEDARA, PRIMERO SE DEBE SALIR DE LA CARPETA ACTUAL
    // SE LE CONCATENA EL ID DEL promo AL QUE PERTENECE
    $ruta_final="../../../../img/promo/promo_".$id.".jpg";
    move_uploaded_file($_FILES["url"]["tmp_name"], $ruta_final);
    echo "Promoción guardada con exito!!";

            
    //-----------------------
    $con->close();
    foreach (@$_COOKIE as $key => $valor){
	@$_COOKIE[$key] = '';
	unset($_COOKIE[$key]);
	 
	}

	
?>