<?php
	$id_Cue=$_POST['id_Cue'];
	$mesa=$_POST['mesa'];
	include('../cuenta.php');
	$inv=new orden();
	$inv->pedirCuenta($id_Cue,$mesa); 
?>

