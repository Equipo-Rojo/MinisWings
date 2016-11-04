<?php
	$id_Cue=$_POST['id_Cue'];
	include('../cuentasMesas.php');
	$inv=new cuentaMesa();
	$inv->Cortesia($id_Cue); 
?>

