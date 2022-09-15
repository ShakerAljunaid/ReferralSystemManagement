<?php 
 require_once('../dbconfig.php');
 $sql = 'SELECT  * from  childGridViewData where Diagnose_closed is null and  (Diagonse_state';
 if($_POST['State']==0)
 $sql .= '='.$_POST['State'].' or  Diagonse_state is null)';
else
 $sql .= '='.$_POST['State'];
 $sql.=' and DiagnoseDate>="'.$_POST['FrmDate'].'" and DiagnoseDate<="'.$_POST['ToDate'].'")' ; 
 if($_SESSION["user_type"]!=436)		
      $sql .=' and diagnonist_id='.$_SESSION["user_id"];  
$ChildData = $pdo->query($sql)->fetchAll();
echo json_encode($ChildData);
//echo $sql;



 ?>


