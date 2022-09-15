<?php 
 require_once('../DBOperations.php');

$param = $_REQUEST;
if(isset($param["CaseId"])){
	$fields=array(":childCaseId",":serviceId",":startingDate",":endingDate",":quantity",":serviceStateId",":createdUserId",":ServiceGiverId");
     $values=array( check_data($param["CaseId"]),9,check_data($param['SrvStrDate']),check_data($param['SrvEndDate']),1,1,$_SESSION["user_id"],check_data($param['AssignedSrvGvr_id']));
           $r= bind_fields('new_child_case_service',$fields,$values);
	   echo $r;
       
 }

