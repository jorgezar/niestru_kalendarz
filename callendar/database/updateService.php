<?php
$name = $_POST["serviceName"];
$time = $_POST["serviceTime"];
$color = $_POST["serviceColor"];
$id = $_POST["serviceId"];
try {
 $bdd = new PDO('mysql:host=localhost;dbname=jorgezar_fullc', 'jorgezar_fullc', 'CDE#4rfv');
 } catch(Exception $e) {
exit('Unable to connect to database.');
}
 // update the records
$sql = "UPDATE services SET serviceName='$name', serviceTime='$time', serviceColor='$color' WHERE serviceId='$id'";
$logfile = fopen('errorlog.txt', 'w');
fwrite($logfile, $sql);

$q = $bdd->prepare($sql);
$q->execute(array($name,$time,$color,$id));
?>