<?php
	$fondo=$_POST['fondo'];
    include('../venta.php');
    $ven = new venta();
    $ven -> setFondo($fondo);
?>