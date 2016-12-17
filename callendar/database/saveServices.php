<?php
$data = $_POST["mydata"];
try {
$connection = new PDO('mysql:host=localhost;dbname=jorgezar_fullc', 'jorgezar_fullc', 'CDE#4rfv');
} catch(Exception $e) {
exit('Unable to connect to database.');
}

foreach ($data as $item){
	$serviceName  = $item['name'];
	$serviceTime  = $item['time'];
	$serviceColor = $item['color'];
	$serviceOrder = $item['index'];
	$serviceId    = $item['id']; 
	$sql = "UPDATE services SET serviceName='$serviceName', serviceTime='$serviceTime', serviceColor='$serviceColor', serviceOrder='$serviceOrder' WHERE serviceId='$serviceId'";
	$query = $connection->prepare($sql);
	$query->execute(array($serviceName, $serviceTime, $serviceColor, $serviceOrder, $serviceId));
};



?>