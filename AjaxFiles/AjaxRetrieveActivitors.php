<?php 
 require_once('../DBOperations.php');

$param = $_REQUEST;
if(isset($param["CaseId"])){
	$sql="select * from userview  u
	left outer join caseservice cs on cs.Service_giver_id =u.ID and Case_id=118
	where User_type_id=442";
	$result=$pdo->query($sql)->fetchAll();
	$resStr='';
	foreach($result  as $act )
	   $resStr.='<option value='.$act['ID'].'>'.$act['First_name'].' '.$act['Last_name'].'</option>';
	echo $resStr;
       
 }

 
?>