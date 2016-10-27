$(document).ready(function(){
    //-- Este metodo embebe los menus de cada categoria -- //
    $('a.pure-menu-link').click(function(event){
        event.preventDefault();
        $id=$(this).attr('href');
        $.ajax({ 
            type: "POST", 
            url: 'modulos/menu/'+$id+'.php',  
            success: function(data) {  
                $("div#main").empty();
                $("div#main").append(data);
            }  
        });  
    });
    //-- Fin -- //
});