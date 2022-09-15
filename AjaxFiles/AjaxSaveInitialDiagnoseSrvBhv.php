<?php 
 require_once('../DBOperations.php');
  require_once('../dbconfig.php');


$param = $_REQUEST;
$resultId = 0;
if(isset($param["diagnoseId"])  )
{
	
	if(isset($param["checkedAct"]))
   { 
   // $ck='';
		$checkActivities=$param["checkedAct"];
		$checkedArrayLength=count($param["checkedAct"]);
		
	   $fields=array(":in_diagnose_id",":in_activity_id");
	   for($i=0;$i<$checkedArrayLength;$i++) {
		     //$ck .=$checkActivities[$i].',';
			  $values=array( $param["diagnoseId"], $checkActivities[$i]);
			   bind_fields('new_initialdiagnose_suggestedserviceActivity',$fields,$values);
		   }
   }
   if(isset($param["unCheckedAct"]))
   { $uncheckActivities=$param["unCheckedAct"];
     $uncheckCaseStringBuilder="";
	 $uncheckedArrayLength=count($param["unCheckedAct"]);
	 
	   for($c=0;$c<$uncheckedArrayLength;$c++)
	   {  
          $uncheckCaseStringBuilder.=$uncheckActivities[$c];
		  if($c<$uncheckedArrayLength-1)
			  $uncheckCaseStringBuilder.=',';
	   }
	
	  $fields=array(":in_diagnose_id",":Activities2Delete");
      $values=array( $param["diagnoseId"],$uncheckCaseStringBuilder);
      bind_fields('delete_initialdiagnose_suggestedserviceActivity',$fields,$values); 
	   
   }
   if(isset($param["checkedBhv"]))
   { 
     
		$checkBehavior=$param["checkedBhv"];
		$checkedArrayLength=count($param["checkedBhv"]);
		
	   $fields=array(":in_diagnose_id",":in_behavior_id");
	   for($i=0;$i<$checkedArrayLength;$i++) {
		  // $ck .=$checkedArrayLength;
			  $values=array( $param["diagnoseId"], $checkBehavior[$i]);
			   bind_fields('new_initialdiagnose_behavior',$fields,$values);
		   }
   }
   if(isset($param["uncheckedBhv"]))
   { $uncheckBehavior=$param["uncheckedBhv"];
     $uncheckCaseStringBuilder="";
	 $uncheckedArrayLength=count($param["uncheckedBhv"]);
	 
	   for($c=0;$c<$uncheckedArrayLength;$c++)
	   {  
          $uncheckCaseStringBuilder.=$uncheckBehavior[$c];
		  if($c<$uncheckedArrayLength-1)
			  $uncheckCaseStringBuilder.=',';
	   }
	
	  $fields=array(":in_diagnose_id",":Behavior2Delete");
      $values=array( $param["diagnoseId"],$uncheckCaseStringBuilder);
      bind_fields('delete_initialdiagnose_behavior',$fields,$values); 
	   
   }
  
  
   echo $param["diagnoseId"] ;
}else
	echo '0';



 
?>