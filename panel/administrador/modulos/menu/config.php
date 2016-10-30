<h1>Configuración</h1>
<form class="pure-form "  method="POST" >
    <fieldset>
        <legend>Cambiar contraseña</legend>

        <div class="pure-g">
            <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Contraseña actual</label>
                <input id="pass" class="pure-u-1-2 change-pass" type="password"  value="" required>
            </div>

           <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Contraseña nueva</label>
                <input id="new" class="pure-u-1-2 change-pass" type="password" value="" required>
            </div>

        </div>
        <br/><br/>
        <button id="guardar" type="submit" class="pure-button button-warning"><i class="fa fa-pencil" aria-hidden="true"></i> Cambiar</button>
        <button id="cancelar" type="reset" class="pure-button button-error"><i class="fa fa fa-ban" aria-hidden="true"></i> Cancelar</button>
    </fieldset>
</form>
<script type="text/javascript">
    //---------- Boton de cambiar contraseña
    $('#guardar').click(function(event){
        event.preventDefault();
        var valido=1;
        $( ".change-pass" ).each(function(){
            if($(this).val()==""){valido=0;}
        });
        if(valido==0){
            alert("Faltan campos");
        }
        else{
            var pass=$('#pass').val();
            var newpass=$('#new').val();
            $.ajax({ 
                data : {pass:pass, new: newpass},
                type: "POST", 
                url: 'php/usuario/changePass.php',  
                success: function(data) {
                    alert(data);
                    var result=data;
                    if(result=="Exito"){
                         $.ajax({ 
                            type: "POST", 
                            url: 'modulos/menu/alert.php',  
                            success: function(data) {
                                $("div#main").empty();
                                $("div#main").append(data);
                            }  
                        });  
                    }
                }  
            }); 
        }
    }); 
    //---------- Boton de cancelar edicion de contraseña
     $('#cancelar').click(function(event){
        event.preventDefault();
        $.ajax({ 
            type: "POST", 
            url: 'modulos/menu/alert.php',  
            success: function(data) {
                $("div#main").empty();
                $("div#main").append(data);
            }  
        });  
        
    });   
</script>

