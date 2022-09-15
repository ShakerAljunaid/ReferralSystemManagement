<?php 
 require_once('../dbconfig.php');
 $sql = 'SELECT  * from  childGridViewData where  Created_date>="'.$_POST['FrmDate'].'" and Created_date<="'.$_POST['ToDate'].'"' ;

$ChildData = $pdo->query($sql)->fetchAll();
echo json_encode($ChildData);



 ?>


