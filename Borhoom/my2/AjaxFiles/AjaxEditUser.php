<?php 
 require_once('../DBOperations.php');
$param = $_REQUEST;
$fields=array(":p_ID",":u_First_name", ":u_Last_name", ":u_Gender", ":u_Phone_no",":u_Email",":u_Password",":u_User_type_id",":u_Position_id", ":u_Created_user");
 $values=array( check_data($param["PID"]),check_data($param["First_name"]), check_data($param["Last_name"]), check_data($param["Gender"]),check_data( $param["Phone_no"]),check_data($param["Email"]),check_data($param["Password"]),check_data($param["User_type_id"]),check_data($param["Position_id"]),1);
 if( bind_fields('edit_user',$fields,$values)){
	 $sql = "SELECT   * From retriveusers"; 
	echo json_encode($pdo->query($sql)->fetchAll());
 }

 
 
?>