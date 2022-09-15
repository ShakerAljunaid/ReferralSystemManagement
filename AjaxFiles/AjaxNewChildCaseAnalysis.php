<?php 
 require_once('../DBOperations.php');

$param = $_REQUEST;
$fields=array(":IsExist",":CaseAnalysisCase_id",":CaseAnalysisCase_reason",":CaseAnalysisLiving_status",":CaseAnalysisVictim_state",":CaseAnalysisCurrent_problem",":CaseAnalysisOther_issues",":CaseAnalysisSuggested_prc_by_referral_manager",":CaseAnalysisSuggested_prc_by_phsyco_specialist",":CaseAnalysisCreated_user",":DisabilityState",":DisabilityId",":ProtecionIssues","@result");
 $values=array( check_data($param["IsAnalysisExist"]),check_data($param["ChildCaseId"]),check_data($param["CaseAnalysisCaseReason"]),check_data($param["rdbCaseAnalysisLivingStatus"]),check_data($param["rdbCaseAnalysisVictimState"]),check_data($param["rdbtnCurrentIssue"]),check_data($param["CaseAnalysisOtherIssues"]),check_data($param["CaseAnalysisSuggestedPrcByReferralManager"]),check_data($param["CaseAnalysisSuggestedPrcByPhsycoSpecialist"]),$_SESSION["user_id"],1,check_data($param["CaseDisabilityId"]),check_data($param["CaseProtecionIssues"]));
 $res= bind_fields_new('new_childcaseanalysis',$fields,$values);
  echo $res>0?$res :0;

?>