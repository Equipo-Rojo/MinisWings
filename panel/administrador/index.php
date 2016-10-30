<?php
session_start();
if(!isset($_SESSION['user'])){
	if($_SESSION['type']!="barman")
	 header('Location: ../');   
}else{
?>
<!doctype html>
<html lang="en">
	<?php include('modulos/head.php'); ?>
	<body>
    	<div id="layout">
<!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
		<?php include('modulos/menu/index.php'); ?>
<!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
		</div>
        <div id="main" class="content">
  
        	<?php include('modulos/menu/home.php'); ?>
      
			
	    </div>
	    <!-- ZONA DE SCRIPTS -->
	    <script src="../../js/alertify.min.js"></script>
	    <script src="../../js/jquery.min.js"></script>
    	<script src="../../js/shell.js"></script>
    	<script src="../../js/menu.js"></script>
	</body>
</html>
<?php }
?>