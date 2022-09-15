<?php 
 $param = $_REQUEST;

 if(isset($param["ChildCaseID"]))
 {
	 $sql = 'SELECT  * from  childcaseanalysis  where Case_id='.$param["ChildCaseID"]; 
     $ChildData = $pdo->query($sql)->fetchAll();
     echo '<script> var JsCaseData='.json_encode($ChildData).';</script>';
	 
	 
 }else{
	if(isset($param["Case_No"])){
		$sql = 'SELECT  * from  childcaseanalysis  where Case_id='.$param["Case_No"]; 
		$ChildData = $pdo->query($sql)->fetchAll();
		echo '<script> var JsCaseData='.json_encode($ChildData).';</script>';
	}else
		echo '<script> var JsCaseData=1;</script>';
 }
