<?php
session_start();
	
 if ($_SESSION["Authorised"] != "Y"){
     header("Location: not_authorised.php"); 
     exit;
 }
 
?>
