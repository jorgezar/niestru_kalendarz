<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<link rel='stylesheet' href='css/template.css' />
<script src='/niestru/callendar/lib/jquery-3.1.1.min.js'></script>
<meta name=viewport content="width=device-width, initial-scale=1">


</head>

<body>

<?php include('modules/menu/menulog.php'); ?>	

<?php include('home.php'); ?>	

<?php include('footer.php'); ?>	


<?php 
//include callendar if logged in, else blank
$logged = true;
if($logged) {
	include('callendar/callendar.php'); 
} else {
	include("callendar/anonymous.php");
}
?>

	
</body>
</html>
