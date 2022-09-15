<?php 
 require_once('../dbconfig.php');
 $sql = 'SELECT  * from  childGridViewData where Specialist_id';
 if($_POST['State']==0)
 $sql .= '='.$_POST['State'];
else
 $sql .= '!='.$_POST['State'];
 $sql.=' and AnalysisDate>="'.$_POST['FrmDate'].'" and AnalysisDate<="'.$_POST['ToDate'].'"' ; 
$ChildData = $pdo->query($sql)->fetchAll();
echo json_encode($ChildData);



 ?>


