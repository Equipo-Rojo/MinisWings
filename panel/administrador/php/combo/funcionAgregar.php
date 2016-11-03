<?php
	$cont = intval($_COOKIE['contador']); //numerp de platillos a agregar
	$nombre=$_POST['nombre'];
	$descipcion=$_POST['descripcion'];
	$precio=$_POST['precio'];

	include ('../conexion.php');
	$con = new Conexion('datosServer.php');

	$sql = "INSERT INTO combos (nombre, descripcion,precio,Estado) VALUES('".$nombre."','".$descipcion."',".$precio.",'activo')";
	$con = $con->conectar();
    $result = $con->query($sql);  // se ejecuta la sentencia
    if($con->affected_rows){

            $sql = "SELECT * FROM combos WHERE Estado='activo' AND Url=''"; //consultar id del combo insertado
            $result = $con->query($sql);
            if ($result->num_rows > 0) {
                $row=$result->fetch_assoc();
                $id_Comb=$row['id_Comb'];

                for($i=1;$i<=$cont;$i++)  // insertar cada campo de la relacion
                {
                    $sql="INSERT INTO r_c_pl (id_Comb,id_Plat,cant) VALUES (".$id_Comb.",".$_POST['id_Plat'.$i].",".$_POST['cant_'.$i].")";
                    $result = $con->query($sql);
                }
                
                
                $ruta_final="img/combo/combo_".$id_Comb.".jpg";
                //--- insertar ruta de imagen
                $sql = "UPDATE combos SET Url='".$ruta_final."' WHERE id_Comb='".$id_Comb."'";
                $result = $con->query($sql);
                if($con->affected_rows){
                	$ruta_final="../../../../img/combo/combo_".$id_Comb.".jpg";
				    move_uploaded_file($_FILES["url"]["tmp_name"], $ruta_final);
				    $con->close();
                    echo "Combo creado con exito!!";
                }
            }
        }      
        //-----------------------


	
?>