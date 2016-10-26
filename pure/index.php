<?php 
	date_default_timezone_set('America/mexico_city'); 
	$time= getDate();
	$mes=["Mes","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
	$date = $time['mday']." de ".$mes[$time['mon']]." de ".$time['year'];
	$time['hours']<10 ? $hora="0".$time['hours'] : $hora=$time['hours'];
	$time['minutes']<10 ? $minutos="0".$time['minutes'] : $minutos=$time['minutes'];
	$time=$hora.":".$minutos;
?>
<!doctype html>
<html lang="en">
	<?php include('modulos/head.php'); ?>
	<body>
    	<div id="layout">
<!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
		<?php include('modulos/menu/index.php'); ?>
<!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->

        <div id="main">

			<div class="hero">
			    <div class="hero-titles">
			        <img class="" src="img/logo_blanco.png" alt="Pure">
			        <h1 class="hero-tagline">Minni's Wings</h1>
			    </div>

			    <div class="hero-cta">
		          	<h2 class="hero-tagline"><?php ?>Bienvenido!</h2>
		          	<h3 class="hero-tagline"><?php echo $date; ?></h3>
		          	<h3 class="hero-tagline"><?php echo $time; ?></h3>
			    </div>
			</div>
	    </div>
	    <!-- ZONA DE SCRIPTS -->
    	<script src="js/shell.js"></script>
	</body>
</html>