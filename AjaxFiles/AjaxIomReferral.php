
<?php 

 require_once('../DBOperations.php');
 
$param = $_REQUEST;
$fields=array(":CaseId",":IomUserId");
 $values=array( check_data($param["CaseId"]),17);
 echo bind_fields('IomReferral',$fields,$values);

 ?>




