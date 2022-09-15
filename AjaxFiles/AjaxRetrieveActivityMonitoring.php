<?php 
 require_once('../dbconfig.php');

$params=$_REQUEST;
$ReturnedArray=[];
	$sql = "SELECT   * From activities_monitoring_data where Case_service_id=".$params['CaseServiceId']; 
      $RegistredActivities=$pdo->query($sql)->fetchAll();
     $sql =  "SELECT ID,Title FROM serviceactivity where Service_id=".$params['ServiceId'];
	   $ServiceActivities= $pdo->query($sql)->fetchAll(); 
	   $ActivitiesOfServiceOptions='';
       foreach ($ServiceActivities  as $sa)
	     $ActivitiesOfServiceOptions.='<option value='.$sa['ID'].' >'.$sa['Title'].'</option>';
$ReturnedArray=	array("RegistredActivities"=>($RegistredActivities),"ServiceActivities"=>$ActivitiesOfServiceOptions);
	

 echo json_encode($ReturnedArray);
 




 ?>
