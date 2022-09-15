
<?php 

 require_once('../DBOperations.php');
 
$param = $_REQUEST;
$fields=array(":CaseId",":ModifiedUserId");
 $values=array( check_data($param["CaseId"]),$_SESSION["user_id"]);
 echo bind_fields('InternalReferral',$fields,$values);

 ?>




