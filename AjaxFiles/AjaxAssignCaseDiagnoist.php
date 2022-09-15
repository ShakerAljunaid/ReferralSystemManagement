<?php 
 require_once('DBOperations.php');

$param = $_REQUEST;
if(isset($param["Case_No"])){
	$fields=array(":CaseID",":CaseModified_user_id",":Case_diagonist_id");
	 $values=array( check_data($param["Case_No"]),$_SESSION["user_id"],$_SESSION["user_id"]);
	 echo bind_fields('assign_childcase_2diagonist',$fields,$values);
}
	 
?>