<?php 
 require_once('../DBOperations.php');

$param = $_REQUEST;
if(isset($param["AnalysisId"])  )
{
	
	if(isset($param["checkedSrv"]))
   { 
    
		$checkedServices=$param["checkedSrv"];
		$checkedArrayLength=count($param["checkedSrv"]);
		echo $checkedArrayLength;
	   $fields=array(":AnalysisId",":ServiceId");
	   for($i=0;$i<$checkedArrayLength;$i++) {
		   //$ck .=$checkServices[$i];
			  $values=array( $param["AnalysisId"], $checkedServices[$i]);
			   bind_fields('new_analysis_sgt_srv',$fields,$values);
		   }
   }
   if(isset($param["unCheckedSrv"]))
   { $uncheckService=$param["unCheckedSrv"];
     $uncheckCaseStringBuilder="";
	 $uncheckedArrayLength=count($param["unCheckedSrv"]);
	 
	   for($c=0;$c<$uncheckedArrayLength;$c++)
	   {  
          $uncheckCaseStringBuilder.=$uncheckService[$c];
		  if($c<$uncheckedArrayLength-1)
			  $uncheckCaseStringBuilder.=',';
	   }
	
	  $fields=array(":AnalysisId",":Services2Delete");
      $values=array( $param["AnalysisId"],$uncheckCaseStringBuilder);
      bind_fields('delete_analysis_sgt_srv',$fields,$values); 
	   
   }
   
   echo $param["AnalysisId"] ;
}else
	echo '0';



 
?>