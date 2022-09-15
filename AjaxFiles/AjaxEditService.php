<?php 
 require_once('../DBOperations.php');

$param = $_REQUEST;
$fields=array(":ServiceID",":ServiceService_cat",":ServiceTitle",":ServiceDecription",":Serviceuser");
 $values=array( check_data($param["s_ID"]),check_data($param["s_Service_cat"]),check_data($param["s_Title"]),check_data($param["s_Decription"]),$_SESSION["user_id"]);
 if( bind_fields('edit_service',$fields,$values))
 {
	 $sql = "SELECT   * From retriveservices;"; 
   echo json_encode($pdo->query($sql)->fetchAll());
 }

 
 
?>