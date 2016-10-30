<div class="pagina">
    <h1>Pagina principal</h1>
    <h2>Promociones vigentes</h2>
    <div class="table-responsive">
        <table class="pure-table pure-table-horizontal">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Fecha</th>
                    <th>Precio</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include('../../php/promo.php');
                    $pla = new promo();
                    $pla -> listarPromo();
                ?>
            </tbody>
        </table>
    </div>
    <h2>Datos de contacto</h2>
    <button class="button-xlarge button-warning pure-button edite-contacto"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</button>
    <div class="table-responsive">
        <table class="pure-table pure-table-horizontal">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Dirección</th>
                    <th>Facebook</th>
                    <th>Telefono</th>
                    <th>Celular</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include('../../php/contacto.php');
                    $pla = new contacto();
                    $pla -> listarContacto();
                ?>
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript">
    //---------- Boton de eliminar producto del inventario
    $('.edite-contacto').click(function(event){
        $.ajax({ 
            type: "POST", 
            url: 'php/contacto/contacto.php',  
            success: function(data) { 
                
                    $("div#main").empty();
                    $("div#main").append(data);
    
            }  
        });  
    });   