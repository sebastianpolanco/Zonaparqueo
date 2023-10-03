<?php
include "conexion.php";
//setting header to json
header('Content-Type: application/json');

$mysqli = new mysqli($host, $user, $pw, $db);


//get connection

if(!$mysqli){
  die("Connection failed: " . $mysqli->error);
}

//query to get data from the table
$sqldata = "SELECT `nivel_CL`, `fecha` FROM `datos_medidos` WHERE 1";

//execute query
$result = $mysqli->query($sqldata); 

//loop through the returned data
$data = array();
foreach ($result as $row) {
  $data[] = $row;
}

//free memory associated with result
$result->close();

//close connection
$mysqli->close();

//now print the data
echo json_encode($data);

?>