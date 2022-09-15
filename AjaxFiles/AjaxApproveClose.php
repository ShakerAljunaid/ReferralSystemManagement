<?php 
 require_once('../DBOperations.php');

$param = $_REQUEST;
$fields=array(":CloseId",":ApproveState",":CloseProcedures",":UserId");
 $values=array( check_data($param["closeId"]),1,check_data($param["CloseProcedures"]),$_SESSION["user_id"]);
 bind_fields('ApproveClose',$fields,$values);
$sql =  "select * from closedCaseView  where Approval_state=0; ";
$CloseRequests=$pdo->query($sql)->fetchAll();

echo json_encode($CloseRequests);
 
 
?>