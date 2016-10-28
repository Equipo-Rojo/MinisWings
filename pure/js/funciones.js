$(document).ready(function(){
    alert("cargar");
    $('button.delete-inventario').click(function(event){
        alert("eliminar");
        /*event.preventDefault();
        $id=$(this).attr('href');
        $.ajax({ 
            type: "POST", 
            url: 'modulos/menu/'+$id+'.php',  
            success: function(data) {  
                $("div#main").empty();
                $("div#main").append(data);
            }  
        });  
        */
    });   
});