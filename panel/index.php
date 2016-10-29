<?php
session_start();
if(!isset($_SESSION['user'])){
	if($_SESSION['type']!="barman")
	 header('Location: ../');   
}
?>