<?php 
 require_once('../DBOperations.php');

$param = $_REQUEST;
$fields=array(":cd_case_id",":cd_close_status",":cd_reason",":cd_user_id");
 $values=array( check_data($param["caseId"]),2,check_data($param["CloseReason"]),$_SESSION["user_id"]);
 bind_fields('edit_closedcase',$fields,$values);
 echo 1;
 
 
 
?>