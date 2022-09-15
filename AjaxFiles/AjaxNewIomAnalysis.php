<?php 
 require_once('../DBOperations.php');

$param = $_REQUEST;
$fields=array(":CaseId",":FamilyBg",":StateHistory",":ProblemsSuggestions",":ChildTotalState",":OrgPrvInterventions",":SuggestedMedcineEqp",":CreatedUserId","@result");
 $values=array( check_data($param["caseId"]),check_data($param["txtFamilyHist"]),check_data($param["txtChildHist"]),check_data($param["txtPrblSgs"]),check_data($param["txtHltSt"]),check_data($param["txtOrgInvn"]),check_data($param["txtSuggestedMedCineEquipment"]),check_data($_SESSION["user_id"]));
 $res= bind_fields_new('new_iom_analysis',$fields,$values);
  echo $res>0?$res :0;

?>