<?php 
$param = $_REQUEST;
 if(isset($param["ID"]))
 {
	 $sql = 'SELECT  * from  child_all_info where ID='.$param["ID"]; 
     $ChildData = $pdo->query($sql)->fetchAll();
     echo '<script> var JsChildData='.json_encode($ChildData).';</script>';
		 
 }else{
	echo '<script> var JsChildData=1;</script>';
 }

