<?php
include_once('connection.php');

get_events();

function get_events(){
	$rows = array();
	$sql = "SELECT * FROM opening_hours ORDER BY day";
	$result = db_query($sql);
	while($row=mysqli_fetch_assoc($result)){
		$rows[]=$row;
	}
	print json_encode($rows);
}
?>

