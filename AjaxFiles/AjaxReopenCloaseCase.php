<?php 
 require_once('../DBOperations.php');

$param = $_REQUEST;
$fields=array(":CloseId",":ReopenReason",":UserId");
 $values=array( check_data($param["closeId"]),check_data($param["ReopenReason"]),$_SESSION["user_id"]);
 bind_fields('ReopenClosedCase',$fields,$values);
$sql =  "select * from closedCaseView  where Approval_state=1; ";
$CloseRequests=$pdo->query($sql)->fetchAll();

echo json_encode($CloseRequests); 
 
 
 
?>