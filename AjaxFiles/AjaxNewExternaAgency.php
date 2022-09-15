<?php 
 require_once('../DBOperations.php');
  require_once('../dbconfig.php');

$param = $_REQUEST;
$fields=array(":ea_Id",":ea_Name",":ea_contact_person",":ea_Agency_phone",":ea_Agency_governate_id",":ea_Agency_address",":ea_created_user_id",":ea_description");
 $values=array( check_data($param["AgencyId"]),check_data($param["AgencyName"]),check_data($param["ContactPersonName"]),check_data($param["AgencyPhoneNo"]),check_data($param["GovernateId"]),check_data($param["AgencyAddress"]),$_SESSION["user_id"],check_data($param["Description"]));
 if(bind_fields('new_externalagency',$fields,$values))
 { $sql = "SELECT   * From externalagency"; 
   echo json_encode($pdo->query($sql)->fetchAll());
 }


 
 
?>