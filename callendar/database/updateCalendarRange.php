<?php
$day = $_POST['day'];
$start = $_POST['start'];
$end = $_POST['end'];

try {
 $bdd = new PDO('mysql:host=localhost;dbname=jorgezar_fullc', 'jorgezar_fullc', 'CDE#4rfv');
 } catch(Exception $e) {
exit('Unable to connect to database.');
}
 // update the records
$sql = "UPDATE opening_hours SET start='$start', end='$end' WHERE day='$day'";
$logfile = fopen('errorlog.txt', 'w');
fwrite($logfile, $sql);

$q = $bdd->prepare($sql);
$q->execute(array($start,$end,$day));
?>