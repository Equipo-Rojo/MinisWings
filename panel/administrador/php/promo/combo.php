<?php
	$num=$_POST['num'];
    include('../Promo.php');
    $ing = new Promo();
    $ing -> listarCombos($num);
?>
