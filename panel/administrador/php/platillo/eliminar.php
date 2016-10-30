<?php
	$id=$_POST['id'];
	include('../platillo.php');
	$inv=new platillo();
	$inv->eliminarPlatillo($id);
?>