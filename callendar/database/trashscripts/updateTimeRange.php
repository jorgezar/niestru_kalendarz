<?php
$timePoint = $_POST['timePoint'];

try {
 $bdd = new PDO('mysql:host=localhost;dbname=jorgezar_fullc', 'jorgezar_fullc', 'CDE#4rfv');
 } catch(Exception $e) {
exit('Unable to connect to database.');
}

$sql = "UPDATE time_range SET range_selected = '$timePoint' where id = 1";


$q = $bdd->prepare($sql);
$q->execute(array($timePoint));
?>