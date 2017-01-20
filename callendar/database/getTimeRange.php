<?php
include_once('connection.php');
get_events();
function get_events(){
	$sql = "SELECT range_selected FROM time_range";
	$result = db_query($sql);
	foreach($result as $item){
		echo json_encode($item);
	}
	
}
?>
 
 