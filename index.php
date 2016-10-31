<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Minni's Wings</title>
        <link rel="shortcut icon" href="img/logo_icon.ico" type="image/ico">
        <link rel="stylesheet" href="css/pure-min.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <!--<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Raleway:200">-->
        <!--[if lte IE 8]>
            <link rel="stylesheet" href="../css/baby-blue.css">
        <![endif]-->
        <!--[if gt IE 8]><!-->
        <link rel="stylesheet" href="css/login.css">
        <!--<![endif]-->
        <!--[if lt IE 9]>
            <script src="../js/html5shiv.js"></script>
        <![endif]-->
    </head>
    <body>
        <div id="main" class="content">
        <h1>Minni's Wings</h1> 
          <form class="form" method="POST" >
            <input type="text" id="nick" name="nick" placeholder="Ingresa tu usuario" required />
            <input type="password" id="pass" name="pass"  placeholder="Ingresa tu contraseña" required />
             <input type="submit" id="login" name="login" value="Entrar" />
            <a href="">¿Olvidaste tu contraseña?</a>
          </form>  
          </div>
    </body>
     <script src="js/alertify.min.js"></script>
</html>
<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      
        $nick=$_POST['nick'];
        $pass=$_POST['pass'];
        include('php/login.php');
        $con=new Login();
        $con->login($nick, $pass);
        

    }
?>
