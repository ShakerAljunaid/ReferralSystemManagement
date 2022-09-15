<?php 
 require_once('../DBOperations.php');

$param = $_REQUEST;
$fields=array(":CareGiver_id",":CareGiverFirst_name",":CareGiverLast_name",":IdentityNo",":CareGiverGender",":CareGiverPhone_no",":Created_user",":CareGiverFax_id",":CareGiverEmail",":Child_id",":ChildFirst_name",":ChildMiddel_name",":ChildLast_name",":ChildGender",":ChildBirth_place",":ChildLiving_governate",":ChildLiving_district",":ChildChildAddress",":ChildCare_giver_relation_id",":ChildMother_alive",":ChildMother_name",":ChildMother_work",":ChildFather_alive",":ChildFather_name",":ChildFather_work",":Case_id",":CaseRequired_service",":ChildAge",":Displaced_state",":ChildSource",":ChildNationality","@Result");
 $values=array( check_data($param["CareGiverId"]),check_data($param["CareGiverFisrtName"]),check_data($param["CareGiverLastName"]),check_data($param["CareGiverIdentity"]),check_data($param["CareGiverGender"]),check_data($param["CareGiverPhoneNo"]),$_SESSION["user_id"],"000","@EFDDD",check_data($param["ChildId"]),check_data($param["ChildFisrtName"]),check_data($param["ChildMiddelName"]),check_data($param["ChildLastName"]),check_data($param["ChildGender"]),check_data($param["ChildBirthGov"]),check_data($param["ChildLivingGov"]),check_data($param["ChildLivingDst"]),check_data($param["ChildAddress"]),check_data($param["CareGiverRelationId"]),check_data($param["MotherAlive"]),check_data($param["MotherName"]),check_data($param["MotherWork"]),check_data($param["FatherAlive"]),check_data($param["FatherName"]),check_data($param["FatherWork"]),check_data($param["CaseId"]),check_data($param["RequiredService"]),check_data($param["ChildAge"]),check_data($param["DisplacedState"]),check_data($param["ChildSource"]),check_data($param["ChildNationality"]));
$result=bind_fields_new('new_child_registerant',$fields,$values);
echo $result;



 
 
?>