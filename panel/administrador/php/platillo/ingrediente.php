<?php
	$num=$_POST['num'];
    include('../platillo.php');
    $ing = new platillo();
    $ing -> listarIngrediente($num);
?>
