<?php 
 require_once('../DBOperations.php');

$param = $_REQUEST;
$fields=array(":CaseAnalysisID",":CaseAnalysisCase_id",":CaseAnalysisCase_reason",":CaseAnalysisLiving_status",":CaseAnalysisVictim_state",":CaseAnalysisCurrent_problem",":CaseAnalysisOther_issues",":CaseAnalysisSuggested_prc_by_referral_manager",":CaseAnalysisSuggested_prc_by_phsyco_specialist",":CaseAnalysisSuggested_services",":CaseAnalysisModified_user_id");
 $values=array( check_data($param["CaseAnalysisID"]),check_data($param["CaseAnalysisCase_id"]),check_data($param["CaseAnalysisCase_reason"]),check_data($param["CaseAnalysisLiving_status"]),check_data($param["CaseAnalysisVictim_state"]),check_data($param["CaseAnalysisCurrent_problem"]),check_data($param["CaseAnalysisOther_issues"]),check_data($param["CaseAnalysisSuggested_prc_by_referral_manager"]),check_data($param["CaseAnalysisSuggested_prc_by_phsyco_specialist"]),check_data($param["CaseAnalysisSuggested_services"]),$_SESSION["user_id"]);
 echo bind_fields('edit_childcaseanalysis',$fields,$values);

 
 
?>