<?php
    $id=$_POST['id'];
    include('../conexion.php');
    $con = new Conexion('datosServer.php');
    $con = $con->conectar();

$sql = "SELECT * FROM inventario WHERE id=".$id;
$result = $con->query($sql);
$producto = $result->fetch_assoc();
?>
<h1>Editar Inventario</h1>
<form class="pure-form pure-form-stacked">
    <fieldset>
        <legend>Producto: <?php echo $producto['producto']; ?></legend>

        <div class="pure-g">
            <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Nombre del producto</label>
                <input id="" class="pure-u-1-2" type="text" value="<?php echo $producto['producto']; ?>" required>
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Descripción</label>
                <textarea id="" class="pure-u-1-2" type="text" required ><?php echo $producto['descripcion']; ?></textarea>
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Cantidad en existencia</label>
                <input id="" class="pure-u-1-2" type="number" step="1" min="0" value="<?php echo $producto['existencia']; ?>" required>
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Existencia minima</label>
                <input id="" class="pure-u-1-2"  type="number" step="1" min="0" value="<?php echo $producto['minimo']; ?>" required>
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Estado</label>
                <select id="" class="pure-input-1-2">
                    <option>Seleccionar...</option>
                    <option<?php if($producto['status']=="inactivo"){echo "selected";} ?> value="inactivo">Inactivo</option>
                    <option <?php if($producto['status']=="activo"){echo "selected";} ?> value="inactivo" >Activo</option>
                </select>
            </div>
        </div>
        <br/><br/>
        <button type="submit" class="pure-button button-warning"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
        <button type="reset" class="pure-button button-error"><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</button>
    </fieldset>
</form>