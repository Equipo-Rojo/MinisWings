<?php
	$num=$_POST['num'];
    include('../combo.php');
    $ing = new combo();
    $ing -> listarPlatillo($num);
?>
