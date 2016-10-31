<?php
	$id=$_POST['id'];
	include('../combo.php');
	$inv=new combo();
	$inv->eliminarcombo($id);
?>