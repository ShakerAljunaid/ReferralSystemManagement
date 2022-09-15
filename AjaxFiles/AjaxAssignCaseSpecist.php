<?php 
 require_once('DBOperations.php');

$param = $_REQUEST;
if(isset($param["ChildCaseID"]) && isset($_SESSION["user_id"])){
	$fields=array(":CaseID",":CaseModified_user_id",":CaseSpecialist_id");
	 $values=array( check_data($param["ChildCaseID"]),$_SESSION["user_id"],$_SESSION["user_id"]);
	 if( bind_fields('childcase_take',$fields,$values))
	 {
		 $sql = 'SELECT  * from  childGridViewData where caseId='.$param["ChildCaseID"]; 
		 $ChildData = $pdo->query($sql)->fetchAll();
		 echo '<script> var JsChildData='.json_encode($ChildData).';</script>';
		 
		 
	 };
 }else{
	if(isset($param["Case_No"])){
		$sql = 'SELECT  * from  childGridViewData where caseId='.$param["Case_No"]; 
		 $ChildData = $pdo->query($sql)->fetchAll();
		 echo '<script> var JsChildData='.json_encode($ChildData).';var ChildID='.$param["Case_No"].'</script>';
	}
 }

 
?>