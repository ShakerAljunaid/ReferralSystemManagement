<?php 
 require_once('../DBOperations.php');
  require_once('../dbconfig.php');


if(isset($_POST["childCaseId"]))
{
	$ChildCaseId=check_data($_POST["childCaseId"]);
  if(isset($_POST["checkedServices"]))
   { $fields=array(":childCaseId",":serviceId",":startingDate",":endingDate",":quantity",":serviceStateId",":createdUserId",":ServiceGiverId");
     foreach($_POST["checkedServices"] as $cs ) {
          $values=array( $ChildCaseId,check_data($cs['ServiceId']),check_data($cs['StartingDate']),check_data($cs['EndingDate']),check_data($cs['Quantity']),check_data($cs['ServiceState']),$_SESSION["user_id"],check_data($cs['ResponsiblePerson']));
           echo bind_fields('new_child_case_service',$fields,$values);
       }
   }
   if(isset($_POST["uncheckedServices"]))
   { $uncheckServices=$_POST["uncheckedServices"];
     $uncheckCaseStringBuilder='';
	 $uncheckedArrayLength=count($_POST["uncheckedServices"]);
	   for($i=0;$i<$uncheckedArrayLength;$i++)
	   {  
          $uncheckCaseStringBuilder.=$uncheckServices[$i];
		  if($i<$uncheckedArrayLength-1)
			  $uncheckCaseStringBuilder.=',';
	   }
	
	  $fields=array(":Child_case_id",":Services2Delete");
      $values=array( $ChildCaseId,$uncheckCaseStringBuilder);
      echo bind_fields('delete_caseservice',$fields,$values); 
	   
   }
	   
      
	

}



 
?>