<?php 
 require_once('../dbconfig.php');
 session_start();

if($_SERVER['REQUEST_METHOD']=="GET")
{ //*----------------Qualification Filter--------------------//
	$sql = "SELECT   * From case_closing_gridviewdata where Case_final_decision_id = 398 OR  Case_final_decision_id = 431 "; 
   echo json_encode($pdo->query($sql)->fetchAll());
	
}
else
{ echo "Error"; }

 




 ?>


