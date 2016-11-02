<?php
	$id_Cue=$_POST['id_Cue'];
	$mesa=$_POST['mesa'];
	include('../cuenta.php');
	$inv=new orden();
	$inv->PagarCuenta($id_Cue,$mesa); 
?>

