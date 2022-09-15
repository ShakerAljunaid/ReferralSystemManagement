<?php 
 require_once('../DBOperations.php');

$param = $_REQUEST;
$fields=array(":p_id",":afp_First_name", ":afp_Last_name", ":afp_Gender", ":afp_Phone_no", ":afp_Created_user",":afp_Agency_id");
 $values=array( check_data($param["PersonID"]),check_data($param["ReferralPersonFirst_name"]), check_data($param["ReferralPersonLast_name"]), check_data($param["ReferralPersonGender"]),check_data( $param["ReferralPersonPhone_no"]),$_SESSION["user_id"],check_data($param["ReferralPersonAgency_id"]));
 IF( bind_fields('edit_agencyreferralperson',$fields,$values)){
	 $sql = "SELECT   * From retrieveagencyreferralperson"; 
   echo json_encode($pdo->query($sql)->fetchAll());
 }
 else
	 echo 0;

 
 
?>