<?php 
 require_once('../DBOperations.php');
  require_once('../dbconfig.php');

echo json_encode($_POST["CheckedAct"]);

if(isset($_POST["CaseId"]))
{
	$ChildCaseId=check_data($_POST["CaseId"]);
  if(isset($_POST["CheckedAct"]))
   { $fields=array(":CaseId",":ActivityId",":TakenDate",":CreatedUserId");
     foreach($_POST["CheckedAct"] as $ca ) {
          $values=array( $ChildCaseId,check_data($ca['ActivityId']),check_data($ca['TakenDate']),$_SESSION["user_id"]);
           echo bind_fields('new_child_case_activity',$fields,$values);
       }
   }
   if(isset($_POST["UncheckedAct"]))
   { $uncheckActivities=$_POST["UncheckedAct"];
     $uncheckCaseStringBuilder='';
	 $uncheckedArrayLength=count($_POST["UncheckedAct"]);
	   for($i=0;$i<$uncheckedArrayLength;$i++)
	   {  
          $uncheckCaseStringBuilder.=$uncheckActivities[$i];
		  if($i<$uncheckedArrayLength-1)
			  $uncheckCaseStringBuilder.=',';
	   }
	
	  $fields=array(":CaseId",":Activities2Delete");
      $values=array( $ChildCaseId,$uncheckCaseStringBuilder);
      echo bind_fields('delete_case_service_activity',$fields,$values); 
	   
   }
	   
      
	

}



 
?>