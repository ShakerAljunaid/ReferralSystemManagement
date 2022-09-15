<?php 
 require_once('../DBOperations.php');

$param = $_REQUEST;
if(isset($param['caseId'])){
	$fields=array(":UserId",":CaseId");
     $values=array(check_data($param['userId']), check_data($param['caseId']));
           $r= bind_fields('change_diagnose_state',$fields,$values);
	  echo '1';
       
 }

