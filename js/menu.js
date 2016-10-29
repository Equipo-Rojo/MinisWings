$(document).ready(function(){
    //-- Este metodo embebe los menus de cada categoria -- //
    $('a.pure-menu-link').click(function(event){
        event.preventDefault();
        $("#layout").removeClass('active');
        $("#menu").removeClass('active');
        $("#menuLink").removeClass('active');
        $id=$(this).attr('href');
        if($id=="out"){
            window.location="modulos/menu/out.php";
        }else{
            $.ajax({ 
                type: "POST", 
                url: 'modulos/menu/'+$id+'.php',  
                success: function(data) {              
                    $("div#main").empty();
                    $("div#main").append(data);
                }  
            });
            
        }
    });
    $('div#main').click(function(event){
        $.ajax({ 
                type: "POST", 
                url: 'modulos/menu/contAlert.php',  
                success: function(data) {              
                    $("a#alert.pure-menu-link").empty();
                    $("a#alert.pure-menu-link").append(data);
                }  
            });  
    });
});