<?php 
 require_once('../DBOperations.php');

$param = $_REQUEST;
if(isset($param["CaseId"])){
		 $sql="select * from caseservice where Service_id=9 and Case_id=".$param["CaseId"];
	echo json_encode($pdo->query($sql)->fetchAll());
       
 }

 
?>