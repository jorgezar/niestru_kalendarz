<?php
include_once('connection.php');
get_events();
function get_events(){
	$sql = "SELECT * FROM evenement ORDER BY id";
	$rows = array();
	$result = db_query($sql);
	while($row = mysqli_fetch_assoc($result)){
		$rows[] = $row;
	}
	print json_encode($rows);	
}
?>