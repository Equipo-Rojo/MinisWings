<?php
    include('../../php/inventario.php');
    $cant = new inventario();
?>
<i class="fa fa-exclamation-circle" aria-hidden="true"> <?php $cant->contarAlerta(); ?> Alertas</i> 

