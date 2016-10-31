<?php
	$id=$_POST['id'];
	include('../Promo.php');
	$inv=new Promo();
	$inv->eliminarPromo($id);
?>