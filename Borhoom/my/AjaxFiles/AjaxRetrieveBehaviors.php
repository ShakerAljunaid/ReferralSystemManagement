<?php 
 require_once('../dbconfig.php');
 session_start();

if($_SERVER['REQUEST_METHOD']=="GET")
{ //*----------------Qualification Filter--------------------//
	$sql = "SELECT   * From behavior_view"; 
   echo json_encode($pdo->query($sql)->fetchAll());
	
}
else
{ echo "Error"; }

 




 ?>


