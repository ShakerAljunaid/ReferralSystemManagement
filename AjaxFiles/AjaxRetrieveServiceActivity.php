<?php 
 require_once('../dbconfig.php');


if($_SERVER['REQUEST_METHOD']=="GET")
{ //*----------------Qualification Filter--------------------//
	$sql = "SELECT   * From retriveserviceactivites"; 
   echo json_encode($pdo->query($sql)->fetchAll());
	
}
else
{ echo "Error"; }

 




 ?>


