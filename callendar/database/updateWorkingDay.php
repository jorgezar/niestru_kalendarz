<?php
$data = $_POST["sliderData"];

try {
 $connection = new PDO('mysql:host=localhost;dbname=jorgezar_fullc', 'jorgezar_fullc', 'CDE#4rfv');
 } catch(Exception $e) {
exit('Unable to connect to database.');
}
foreach($data as $item){
	$open = $item["isOpen"];
	if($open == 'true'){
		$open = '1';
		} else {
		$open = '0';
		}
	$day = $item["day"];
	$start = $item["start"];
	$end = $item["end"];
	$sql = "UPDATE opening_hours SET start = '$start', end = '$end', open = '$open' WHERE day = '$day'";
	$query = $connection->prepare($sql);
	$query->execute(array($start, $end, $open, $dayId));
	$logfile = fopen('errorlog.txt', 'w');
	fwrite($logfile, $sql);

	}

?>