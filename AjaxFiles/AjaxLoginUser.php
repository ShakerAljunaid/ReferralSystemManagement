<?php 
 require_once('../dbconfig.php');


if($_SERVER['REQUEST_METHOD']=="POST")
{ //*----------------Qualification Filter--------------------//
	$param = $_REQUEST;
	if(isset($param["UserName"]) && isset($param["Password"])){
		$sql = "SELECT ID, Email, User_type_id, Position_id, Active FROM user WHERE Active=1 AND Email='".$param["UserName"]."' AND Password ='".$param["Password"]."'; "; 
		$result = $pdo->query($sql)->fetch();
		if(!$result)
		 	echo "اسم المستخدم او كلمة المرور خطأ";
		else{
			$_SESSION["user_id"] = $result['ID'];
			$_SESSION["user_name"] = $result['Email'];
			$_SESSION["user_type"] = $result['User_type_id'];
			$_SESSION["user_position"] = $result['Position_id'];
			
			echo '1';
			//header('Location: ../index.php');
		}
	}else{
		echo "يرجى إدخال اسم المستخدم وكلمة المرور";
	}
}
else
{ echo "0"; }

 




 ?>


