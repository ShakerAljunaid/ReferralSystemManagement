<?php 
 require_once('../dbconfig.php');


if(isset($_REQUEST))
{ //*----------------Qualification Filter--------------------//
	$sql = "SELECT   * From retriveusers"; 
   echo json_encode($pdo->query($sql)->fetchAll());
	
}
else
{ echo "Error"; }

 




 ?>


