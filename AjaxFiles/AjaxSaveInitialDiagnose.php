<?php 
 require_once('../DBOperations.php');
  require_once('../dbconfig.php');


$param = $_REQUEST;
$resultId = 0;
if(isset($param["ChildCaseId"]))
{
	$Suicide = 1;
	$Violence = 1;
	$Addiction = 1;
	if(!isset($param["rdbSuicide"]) || $param["rdbSuicide"] == 0)
		$Suicide = 0;
	if(!isset($param["rdbViolence"]) || $param["rdbViolence"] == 0)
		$Violence = 0;
	if(!isset($param["rdbAddiction"]) || $param["rdbAddiction"] == 0)
		$Addiction = 0;
	
	$ChildCaseId=check_data($param["ChildCaseId"]);
	$fields=array(":ind_id",":ind_case_id",":ind_main_complaint",":ind_reasons",
	':ind_other_Behaviors', ':ind_Behaviors_Desc', ':ind_Detailed_Diagnoses', ':ind_Behavior_Degree',
	':ind_Important_Behaviors', ':ind_Performance_Degree', ':ind_Behaviors_Period', ':ind_Diagnose_Date', 
	':ind_Other_Factors', ':ind_Factors_Desc', ':rdbSuicide', ':rdbViolence', ':rdbAddiction', 
	':ind_Medical_Problems', ':ind_Knowledge_Assessment', ':ind_Psych_Drugs', ':ind_Assessment_Note',
	":ind_taken_actions",":ind_recommendations",":ind_suggestions",":ind_user_id","@Result");
	
	$values=array( check_data($param['Diagnose_id']),$ChildCaseId,check_data($param['ind_main_complaint']),check_data($param['ind_reasons']),
	check_data($param['ind_other_Behaviors']),check_data($param['ind_Behaviors_Desc']),check_data($param['ind_Detailed_Diagnoses']),check_data($param['ind_Behavior_Degree']),
	check_data($param['ind_Important_Behaviors']),check_data($param['ind_Performance_Degree']),check_data($param['ind_Behaviors_Period']),check_data($param['ind_Diagnose_Date']),check_data($param['ind_Other_Factors']),check_data($param['ind_Factors_Desc']),
	check_data($Suicide),check_data($Violence),check_data($Addiction),check_data($param['ind_Medical_Problems']),check_data($param['ind_Knowledge_Assessment']),check_data($param['ind_Psych_Drugs']),check_data($param['ind_Assessment_Note']),
	check_data($param['ind_taken_actions']),check_data($param['ind_recommendations']),check_data($param['ind_suggestions']),$_SESSION["user_id"]);
	$resultId = bind_fields_new('edit_initialdiagnose',$fields,$values);

	 echo $resultId;
}else
	echo '0';



 
?>