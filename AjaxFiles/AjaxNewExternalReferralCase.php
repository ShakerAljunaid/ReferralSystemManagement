<?php 
 require_once('../DBOperations.php');

$param = $_REQUEST;


$fields=array(":efc_Case_id",":efc_person_id",":efc_note",":efc_user");
 $values=array( check_data($param["ChildCaseId"]),check_data($param["ReceiverPersonName"]),check_data($param["ExternalreferralNote"]),$_SESSION["user_id"]);
 if (bind_fields('new_externalreferralcase',$fields,$values)){
		$sql = 'SELECT ef.ID as erc_Id, ef.Case_id, afp.Agency_id, ef.Agency_person_id, ef.Note FROM externalreferralcase as ef INNER JOIN agencyreferralperson as afp ON ef.Agency_person_id = afp.ID WHERE ef.Case_id ='.$param["ChildCaseId"]; 
		$ExternalData = $pdo->query($sql)->fetchAll();
	 
		echo json_encode($ExternalData);
	}
 else
	echo '0';
 //$param["CaseAnalysisCaseId"]
 
?>