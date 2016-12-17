<?php
// List of events
 $json = array();

 // Query that retrieves events
 $query = "SELECT * FROM opening_hours ORDER BY day";

 // connection to the database
 try {
 $bdd = new PDO('mysql:host=localhost;dbname=jorgezar_fullc', 'jorgezar_fullc', 'CDE#4rfv');
 } catch(Exception $e) {
  exit('Unable to connect to database.');
 }
 // Execute the query
 $resultat = $bdd->query($query) or die(print_r($bdd->errorInfo()));

 // sending the encoded result to success page
 echo json_encode($resultat->fetchAll(PDO::FETCH_ASSOC));

?>