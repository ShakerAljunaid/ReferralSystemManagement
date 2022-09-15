<?php 
 require_once('../DBOperations.php');

$param = $_REQUEST;
if(isset($param['childId'])){
	$fields=array(":childId");
     $values=array( check_data($param['childId']));
           $r= bind_fields('DeleteChild',$fields,$values);
	   if($r)
	   {  $sql = 'SELECT  * from  childGridViewData'; 
          $ChildData = $pdo->query($sql)->fetchAll();
		  echo json_encode($ChildData);
	   }
       
 }

