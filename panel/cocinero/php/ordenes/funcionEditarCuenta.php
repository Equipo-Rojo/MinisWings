<?php
	$id_Ord = json_decode($_POST['id_Ord']);
	$estado = json_decode($_POST['estado']);
	 include('../conexion.php');
    $con = new Conexion('datosServer.php');
    $con = $con->conectar();

	$sql = array();
	$sql1 = array();
	$consulta =array();
    foreach($estado as $e)
    {
       $sql[]="UPDATE orden SET estado='".$e."'";
    }
    foreach($id_Ord as $e)
    {
       $sql1[]=" WHERE id_Ord=".$e;
    }
    $cont = count($sql);
    for ($i = 0; $i < $cont; $i++)
	{
	        $consulta[]=array_pop($sql).array_pop($sql1);
	}

	 foreach($consulta as $e)
    {
       $result = $con->query($e);
    }
    echo "Cuenta actualizada!!";
       
?>