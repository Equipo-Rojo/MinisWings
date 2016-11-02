<?php
    $id_Ord=$_POST['id_Ord'];
    include('../bebida.php');
    $ord=new orden();
    $ord->ordenPreparando($id_Ord);
    
?>