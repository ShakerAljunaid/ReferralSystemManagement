
<?php 
 require_once('../DBOperations.php');
$fields=array(":RowId");
$values=array( check_data($_POST["RowId"]));
$r=bind_fields('deleteMonitoringActivity',$fields,$values);

echo $r;
