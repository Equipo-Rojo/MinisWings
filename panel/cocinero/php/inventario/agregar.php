<h1>Agregar a  Inventario</h1>
<form class="pure-form pure-form-stacked">
    <fieldset>
        <legend>Nuevo Producto</legend>

        <div class="pure-g">
            <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Nombre del producto</label>
                <input id="" class="pure-u-1-2" type="text" value="" required>
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Descripción</label>
                <textarea id="" class="pure-u-1-2" type="text" required ></textarea>
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Cantidad en existencia</label>
                <input id="" class="pure-u-1-2" type="number" step="1" min="0" value="" required>
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Existencia minima</label>
                <input id="" class="pure-u-1-2"  type="number" step="1" min="0" value="" required>
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Estado</label>
                <select id="" class="pure-input-1-2">
                    <option>Seleccionar...</option>
                    <option value="inactivo">Inactivo</option>
                    <option value="inactivo" >Activo</option>
                </select>
            </div>
        </div>
        <br/><br/>
        <button type="submit" class="pure-button button-warning"><i class="fa fa-plus" aria-hidden="true"></i> Agregar</button>
        <button type="reset" class="pure-button button-error"><i class="fa fa fa-ban" aria-hidden="true"></i> Cancelar</button>
    </fieldset>
</form>