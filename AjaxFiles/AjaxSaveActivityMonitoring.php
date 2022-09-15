
<?php 

 require_once('../DBOperations.php');

$param = $_REQUEST;
$singleAct=explode(',',$param['slcAct']);

if(count($singleAct)>0)
{  $r=0;
	$fields=array(":RowId",":case_service_id",":case_activity_id",":day_date",":spend_period_No",":spend_period_id",":rate_id",":created_user_id",":notes");
	foreach($singleAct as $act)
	{$values=array( check_data($param["nmId"]),check_data($param["nmCaseServId"]),check_data($act),check_data($param["dtCurrentDate"]),1,384,check_data($param["slcRateId"]),$_SESSION["user_id"],check_data($param["txtComment"]));
	 $r=bind_fields('new_activity_monitoring',$fields,$values);
	}
	if($r)
	{$sql = "SELECT   * From activities_monitoring_data where Case_service_id=".$param['nmCaseServId']; 
	echo json_encode( $RegistredActivities=$pdo->query($sql)->fetchAll());}
	else 
	echo "Error";
}	

else 
	echo "Error2";


