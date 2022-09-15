<?php 
 require_once('../DBOperations.php');

$param = $_REQUEST;
$fields=array(":CaseId",":FamilyEchoBg",":RequiredIntverntion",":CaseHistory",":notes",":CreatedUserId","@result");
 $values=array( check_data($param["caseId"]),check_data($param["txtFamilyHist"]),check_data($param["txtRequiredInterbention"]),check_data($param["txtCaseHistory"]),check_data($param["txtNotes"]),$_SESSION["user_id"]);
 $res= bind_fields_new('new_iom_analysis_echo',$fields,$values);
  echo $res>0?$res :0;

?>