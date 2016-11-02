<?php
    $id_Ord=$_POST['id_Ord'];
    include('../cuenta.php');
    $ord=new orden();
    $ord->ordenCocinando($id_Ord);
    
?>