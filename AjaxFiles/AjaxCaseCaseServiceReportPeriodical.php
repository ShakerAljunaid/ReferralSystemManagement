<?php 
 require_once('../dbconfig.php');
 $sql = 'SELECT  * from  allservicesofferedreport where  Created_date>="'.$_POST['FrmDate'].'" and Created_date<="'.$_POST['ToDate'].'"' ;
  if($_POST['userType']!=436){
    $sql .=' where Created_user_id='.$_POST['userId'];
    if($_POST['userType']==433)
		$sql .=' and Service_id=10;';}
$ChildData = $pdo->query($sql)->fetchAll();
echo json_encode($ChildData);



 ?>


