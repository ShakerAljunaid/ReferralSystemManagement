<?php 
 require_once('../DBOperations.php');
  require_once('../dbconfig.php');
$param = $_REQUEST;
$fields=array(":ItemId",":ItemTitle",":ItemListTypeId","@result");
 $values=array(check_data($param["s_ID"]),check_data($param["s_Title"]),check_data($param["s_TypeId"]));
$result=bind_fields_new('New_manylist_item',$fields,$values);

$sql =  "SELECT ID,Title, List_type_id  FROM manylist where List_type_id=".$param["s_TypeId"];
$ManyListData=$pdo->query($sql)->fetchAll();

echo json_encode($ManyListData);



 
 
?>