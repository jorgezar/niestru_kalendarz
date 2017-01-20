<?php
include_once('connection.php');
get_events();
// sending the encoded result to success page
// echo json_encode($resultat->fetchAll(PDO::FETCH_ASSOC));
function get_events(){
	$rows = array();
	$sql = "SELECT * FROM services ORDER BY serviceOrder ASC";
	$result = db_query($sql);
	while($row = mysqli_fetch_assoc($result)){
		$rows[] = $row;
	}
	print json_encode($rows);
}

?>