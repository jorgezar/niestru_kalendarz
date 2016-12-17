<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<link rel='stylesheet' href='css/template.css' />
<meta name=viewport content="width=device-width, initial-scale=1">
</head>


<?php include('modules/menu/menulog.php'); ?>	


<?php 
//include callendar if logged in, else blank
$logged = true;
if($logged) {
	include('callendar/callendar.php'); 
} else {
	include("callendar/anonymous.php");
}
?>


<?php include('footer.php'); ?>	

	

</html>