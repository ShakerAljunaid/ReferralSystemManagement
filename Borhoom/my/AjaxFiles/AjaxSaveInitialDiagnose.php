<?php 
 require_once('../DBOperations.php');
  require_once('../dbconfig.php');

$param = $_REQUEST;
$resultId = 0;
if(isset($param["ChildCaseId"]))
{
	$ChildCaseId=check_data($param["ChildCaseId"]);
	$fields=array(":ind_id",":ind_case_id",":ind_main_complaint",":ind_reasons",":ind_taken_actions",":ind_recommendations",":ind_suggestions",":ind_user_id","@Result");
	$values=array( check_data($param['Diagnose_id']),$ChildCaseId,check_data($param['ind_main_complaint']),check_data($param['ind_reasons']),check_data($param['ind_taken_actions']),check_data($param['ind_recommendations']),check_data($param['ind_suggestions']), 1);
	$resultId = bind_fields_new('edit_initialdiagnose',$fields,$values);
	
	
	if(isset($param["CheckedService"]))
   { 
		$checkServices=$param["CheckedService"];
		$checkedArrayLength=count($param["CheckedService"]);
		//echo $checkedArrayLength;
	   $fields=array(":in_diagnose_id",":in_service_id");
	   for($i=0;$i<$checkedArrayLength;$i++) {
			  $values=array( $resultId, $checkServices[$i]);
			   bind_fields('new_initialdiagnose_suggestedservices',$fields,$values);
		   }
   }
   if(isset($param["UnCheckedService"]))
   { $uncheckServices=$param["UnCheckedService"];
     $uncheckCaseStringBuilder='';
	 $uncheckedArrayLength=count($param["UnCheckedService"]);
	   for($c=0;$c<$uncheckedArrayLength;$c++)
	   {  
          $uncheckCaseStringBuilder.=$uncheckServices[$c];
		  if($c<$uncheckedArrayLength-1)
			  $uncheckCaseStringBuilder.=',';
	   }
	
	  $fields=array(":in_diagnose_id",":Services2Delete");
      $values=array( $resultId,$uncheckCaseStringBuilder);
      bind_fields('delete_initialdiagnose_suggestedservices',$fields,$values); 
	   
   }
   echo $resultId;
}else
	echo '0';



 
?>