<?php 
 require_once('DBOperations.php');

$param = $_REQUEST;
$fields=array(":CaseID",":CaseModified_user_id",":CaseSpecialist_id");
 $values=array( check_data($param["ChildCaseID"]),$_SESSION["user_id"],$_SESSION["user_id"]);
 if( bind_fields('new_case_service',$fields,$values))
 {
	 $sql = 'SELECT  * from  childGridViewData where caseId='.$param["ChildCaseID"]; 
     $ChildData = $pdo->query($sql)->fetchAll();
     echo '<script> var JsChildData='.json_encode($ChildData).';</script>';
	 
	 
 };

 //$param["CaseAnalysisCaseId"]
 
?>