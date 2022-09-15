
<?php 
 require_once('../DBOperations.php');

$param = $_REQUEST;
if(isset($param["CaseId"])){
	$fields=array(":CaseId",":ActivitorId",":ServiceId");
     $values=array( check_data($param["CaseId"]),check_data($param["ActivitorId"]),9);
           $r= bind_fields('AssignServiceGiver',$fields,$values);
	  
	   if($r>0)
	   {$sql=" ".$param['Qry']." ;";
         echo json_encode($pdo->query($sql)->fetchAll());
	   }
	        
       
 }

 




