<?php 
 require_once('../DBOperations.php');

$param = $_REQUEST;
if(isset($param["ChildFisrtName"])){
	$fields=array(":CFNM",":CMNM",":CLNM",":CCGID","@Result");
	 $values=array( check_data($param["ChildFisrtName"]),check_data($param["ChildMiddelName"]),check_data($param["ChildLastName"]),check_data($param["CareGiverIdentity"]));
	 echo  bind_fields_new('check_child_data4Rep',$fields,$values);
 }

 //$param["CaseAnalysisCaseId"]
 
?>