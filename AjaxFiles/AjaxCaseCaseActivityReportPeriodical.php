<?php 
 require_once('../dbconfig.php');
 
 $sql = 'SELECT  *,FindCaseNoOfDaysFrqAct(childCaseId,"'.$_POST['FrmDate'].'","'.$_POST['ToDate'].'") as NoOfFrequencies,	case when FindCaseNoOfDaysFrqAct(childCaseId,"'.$_POST['FrmDate'].'","'.$_POST['ToDate'].'") >1 then "نعم" else "لا" end as FrequencyState		 from allofferedactivities where  Day_date>="'.$_POST['FrmDate'].'" and Day_date<="'.$_POST['ToDate'].'"' ;
  if($_POST['userType']==433){
    $sql .=' and Created_user_id='.$_POST['userId'];
    if($_POST['userType']==433)
		$sql .=' and Service_id=10;';}
$ChildData = $pdo->query($sql)->fetchAll();
echo json_encode($ChildData);



 ?>


