<?php 
 require_once('../DBOperations.php');

$param = $_REQUEST;
if(isset($param['caseId'])){
	$fields=array(":UserId",":CaseId");
     $values=array(check_data($param['userId']), check_data($param['caseId']));
           $r= bind_fields('reopen_diagnose_state',$fields,$values);
	   $sql = 'SELECT  * from  childGridViewData where Diagonse_state!=0 and Diagnose_closed =1';
if($_SESSION["user_type"]!=436)		
      $sql .=' and diagnonist_id='.$_SESSION["user_id"]; 
	$ChildData = $pdo->query($sql)->fetchAll();
echo json_encode($ChildData);
       
 }

