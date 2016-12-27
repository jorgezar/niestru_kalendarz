<?php
// Values received via ajax
$name = $_POST['name'];
$time = $_POST['time'];
$color = $_POST['color'];
// connection to the database
try {
$bdd = new PDO('mysql:host=localhost;dbname=jorgezar_fullc', 'jorgezar_fullc', 'CDE#4rfv');
} catch(Exception $e) {
exit('Unable to connect to database.');
}

// insert the records
$sql = "INSERT INTO services (serviceName, serviceTime, serviceColor) VALUES (:name, :time, :color)";
$logfile = fopen('errorlog.txt', 'w');
fwrite($logfile, $sql);
$q = $bdd->prepare($sql);
$q->execute(array(':name'=>$name, ':time'=>$time, ':color'=>$color));
?>