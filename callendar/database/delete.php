<?php

/* Values received via ajax */
$id = $_POST['id'];

// connection to the database
try {
 $bdd = new PDO('mysql:host=localhost;dbname=jorgezar_fullc', 'jorgezar_fullc', 'CDE#4rfv');
 } catch(Exception $e) {
exit('Unable to connect to database.');
}
 // update the records
$sql = "DELETE FROM evenement WHERE id='$id'";
$q = $bdd->prepare($sql);
$q->execute(array($id));
?>