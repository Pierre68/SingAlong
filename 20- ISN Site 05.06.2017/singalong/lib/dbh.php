<?php

//Local
$conn = mysqli_connect("localhost","root","","exds");
//Server
//$conn = mysqli_connect("localhost","id1617443_exds","pierre12345","id1617443_exds");

if(!$conn){
  die("Connection failed: ".mysqli_connect_error());  // TODO ENLEVER AVANT DE METTRE EN LIGNE CAR HAKING POSSIBLE SINON (SQL injections)
}

 ?>
