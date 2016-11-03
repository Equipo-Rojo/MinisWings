<?php
	$num=$_POST['num'];
    include('../promo.php');
    $ing = new promo();
    $ing -> listarPlatillo($num);
?>
