<?php
	$id_Cue=$_POST['id_Cue'];
	include('../cuentasMesas.php');
	$inv=new cuentaMesa();
	$inv->Pagar($id_Cue); 
?>

