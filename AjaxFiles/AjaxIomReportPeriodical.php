<?php 
 require_once('../dbconfig.php');
 
$sql="SELECT IOMR.*,'إب -الظهار' as FAName,'1' as FANumber,'إب' FAGov,'الظهار' FADst,'' Notes,(CASE WHEN (FindCaseNoOfDaysFrqAct(IOMR.caseId, '".$_POST['FrmDate']."', '".$_POST['ToDate']."') > 0) THEN 'نعم' ELSE 'لا' END) AS RepeatedVistor FROM IomReportView IOMR where IOMR.Created_date>='".$_POST['FrmDate']."' and IOMR.Created_date<='".$_POST['ToDate']."' ;";
$FAReport = $pdo->query($sql)->fetchAll();
echo json_encode($FAReport);



 ?>


