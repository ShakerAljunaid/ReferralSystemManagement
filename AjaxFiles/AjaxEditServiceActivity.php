<?php 
 require_once('../DBOperations.php');

$param = $_REQUEST;
$fields=array(":sc_id",":sc_service_id",":sc_Title",":sc_Needed_period_No",":sc_Needed_period_id",":sc_user_id");
 $values=array( check_data($param["ServiceActivityID"]),check_data($param["slcServicesId"]),check_data($param["ServiceActivityTitle"]),check_data($param["ServiceActivityNeeded_period_No"]),check_data($param["ServiceActivityNeeded_period_id"]),$_SESSION["user_id"]);
 if( bind_fields('edit_serviceactivity',$fields,$values)){
	 $sql = "SELECT   * From retriveserviceactivites"; 
     echo json_encode($pdo->query($sql)->fetchAll());
 }

 
 
?>