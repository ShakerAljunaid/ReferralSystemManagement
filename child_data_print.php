<?php require_once('print_header.php');require_once('dbconfig.php');
 $sql="select * from child_all_info where ID=".$_GET['ChildId'];
 $result=current($pdo->query($sql)->fetchAll());
 
 
?>
<div class="container">   
 <div class="row" >
 <div class="col-sm-2"></div>
 <div class="col-sm-8">

	
	
	 <div class="col-sm-4"><h3 class="small-line">  بيانات الطفل الاساسية </h3></div>
	  
	
	
	 <div class="panel-body">
	 <table class="table table-bordered table-striped" >
	 <thead>
	 <th> الرقم</th>
	 <th> الاسم الاول</th>
	 <th> الاسم الاوسط</th>
	 <th> الاسم الاخير</th>
	 <th> النوع</th>
	 <th> تاريخ التسجيل</th>
	 
	 </thead>
	<tr>
	<td> <?php echo $result['ID'] ; ?></td>
	<td> <?php echo $result['chiled_first_name'] ; ?></td>
	 <td> <?php echo $result['chiled_middel_name'] ; ?></td>
	<td> <?php echo $result['chiled_last_name'] ; ?></td>
	 <td> <?php echo $result['Gender_name'] ; ?></td>
	 <td> <?php echo $result['Created_date'] ; ?></td>
	</tr>
	
	 </table>
	 </div>
	
	
	
	<div class="col-sm-4"><h3 class="small-line">  بيانات السكن والميلاد </h3></div>
	 <div class="panel-body">
	 <table class="table table-bordered table-striped" >
	 <thead>
	 <th> المحافظة</th>
	 <th> المديرية</th>
	 <th> العنوان</th>
	 <th> العمر</th>
	 <th> مكان الميلاد</th>
	
	 </thead>
	<tr>
	<td> <?php echo $result['Living_governate_name'] ; ?></td>
	<td> <?php echo $result['Living_district_name'] ; ?></td>
	 <td> <?php echo $result['Address'] ; ?></td>
	<td> <?php echo $result['Age'] ; ?></td>
	 <td> <?php echo $result['Birth_place_title'] ; ?></td>
	</tr>
	
 
	 </table>
	 </div>


	 <div class="col-sm-4"><h3 class="small-line">  بيانات مقدم الرعاية </h3></div>
	  
	 
	 <div class="panel-body">
	 <table class="table table-bordered table-striped" >
	 <thead>
	 <th> الاسم الاول</th>
	 <th> الاسم الاخير</th>
	 <th> رقم الهاتف</th>
	  <th> رقم البطاقة</th>
	   <th> صلة القرابة</th>
	     <th> النوع</th>
	 </thead>
	<tr>
	<td> <?php echo $result['giver_first_name'] ; ?></td>
	<td> <?php echo $result['giver_last_name'] ; ?></td>
	 <td> <?php echo $result['Phone_no'] ; ?></td>
	 <td> <?php echo $result['Identity_no'] ; ?></td>
	<td> <?php echo $result['relation_name'] ; ?></td>
	 <td> <?php echo $result['care_gender'] ; ?></td>
	
	</tr>
	
 
	 </table>
	 </div>
	
	
	 <div class="col-sm-4"><h3 class="small-line">  بيانات والدي الطفل </h3></div>
	 
	 <div class="panel-body">
	 <table class="table table-bordered table-striped" >
	 <thead>
	 <th> اسم الام</th>
	 <th> حالة الأم</th>
	 <th> عمل الأم</th>
	  <th> اسم الأب</th>
	   <th> حالة الأب</th>
	     <th> عمل الأب</th>
	 </thead>
	<tr>
	<td> <?php echo $result['Mother_name'] ; ?></td>
	<td> <?php echo $result['Mother_alive'] ; ?></td>
	 <td> <?php echo $result['Mother_work'] ; ?></td>
	 <td> <?php echo $result['Father_name'] ; ?></td>
	<td> <?php echo $result['Father_alive'] ; ?></td>
	 <td> <?php echo $result['Father_work'] ; ?></td>
	
	</tr>
	
	 </table>
	 </div>
	 
	
	 <div class="col-sm-4"><h3 class="small-line">  سبب تسجيل الحالة </h3></div>
	  
	 
	 <div class="panel-body">
	 <table class="table table-bordered table-striped" >
	 <thead>
	 <th> السبب</th>
	
	 </thead>
	<tr>
	
	 <td> <?php echo $result['Required_service'] ; ?></td>
	
	</tr>
	
	 </table>
	 </div>
	</div>
 </div>
</div>