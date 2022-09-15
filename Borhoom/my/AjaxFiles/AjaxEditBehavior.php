<?php 
 require_once('../DBOperations.php');
$param = $_REQUEST;
$result = 0;
$fields=array(":behavior_id",":behavior_title",":behavior_parent_id");
 $values=array( check_data($param["s_ID"]),check_data($param["s_Title"]),check_data($param["s_Behavior_cat"]));
 if( bind_fields('edit_behavior',$fields,$values))
 {
	 $sql = "SELECT   * From behavior_view;"; 
   echo json_encode($pdo->query($sql)->fetchAll());
 }

 
 
?>