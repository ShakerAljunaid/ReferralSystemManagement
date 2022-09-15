<?php 
 require_once('../DBOperations.php');
$param = $_REQUEST;
$fields=array(":cd_id",":cd_case_id",":cd_close_status",":cd_reason",":cd_user_id");
 $values=array( check_data($param["CaseClose_ID"]),check_data($param["CaseClose_Case_ID"]),check_data($param["CaseClose_status"]),check_data($param["CaseClose_reason"]),1);
 if( bind_fields('edit_closedcase',$fields,$values))
 {
	 $sql = "SELECT   * From case_closing_gridviewdata where Case_final_decision_id = 398 OR  Case_final_decision_id = 431 "; 
   echo json_encode($pdo->query($sql)->fetchAll());
 }

 
 
?>