<?php require_once('print_header.php');require_once('dbconfig.php');
$sql = 'SELECT  * from  printchildcaseanalysis where Case_id='.$_GET['ChildCaseId'];
$AnalysisData = current($pdo->query($sql)->fetchAll());

$sql = 'SELECT  * from  childGridViewData where caseId='.$AnalysisData["Case_id"]; 
$ChildData = current($pdo->query($sql)->fetchAll());

$sql="SELECT s.Title Service,sc.Title ServiceCategory,cn.Other_issues from case_analysis_suggested_services sgs
  join service s on sgs.Service_id=s.ID
  JOIN childcaseanalysis cn on cn.ID=sgs.Analysis_id
  join manylist sc on sc.ID=s.Service_cat and sc.List_type_id=4
  where cn.Case_id=".$AnalysisData["Case_id"]; 
 $SgsServ= $pdo->query($sql)->fetchAll();
 $Srvtbl='';
 foreach($SgsServ as $sgs)
     $Srvtbl.= '<tr><td>'.$sgs['Service'].'</td><td>'.$sgs['ServiceCategory'].'</td></tr>';
	
?>
<div class="container">   
 <div class="row" >
 <div class="col-sm-2"></div>
 <div class="col-sm-8">

	
	
	 <div class="col-sm-4"><h3 class="small-line">  بيانات الطفل الاساسية </h3></div>
	  
	
	
	 <div class="panel-body">
	 <table class="table table-bordered table-striped" >
	 <thead>
	 <th  data-field="childId" >الرقم</th>
		<th data-field="ChildFullName"  >اسم الطفل</th>
		<th  data-field="Gender" >النوع</th>
			 <th  data-field="Age" >العمر</th>
		<th  data-field="CareGiverFullName" >مقدم الرعاية</th>
		<th  data-field="CareGiverPhoneNo" >رقم الهاتف</th>
		<th  data-field="ChildAddress" > العنوان</th>
		<th  data-field="ParentState" > حالة الوالدين</th>
	 
	 </thead>
	<tr>
	<td> <?php echo $ChildData['childId'] ; ?></td>
	<td> <?php echo $ChildData['ChildFullName'] ; ?></td>
	 <td> <?php echo $ChildData['Gender'] ; ?></td>
	 <td> <?php echo $ChildData['Age'] ; ?></td>
	<td> <?php echo $ChildData['CareGiverFullName'] ; ?></td>
	 <td> <?php echo $ChildData['CareGiverPhoneNo'] ; ?></td>
	 <td> <?php echo $ChildData['ChildAddress'] ; ?></td>
	 <td> <?php echo $ChildData['ParentState'] ; ?></td>
	 
	</tr>
	
	 </table>
	 </div>
	
	<?php if($_SESSION["user_type"]!=524){?>	
	<div class="col-sm-4"><h3 class="small-line">  بيانات حالة الطفل </h3></div>
	 <div class="panel-body">
	 <table class="table table-bordered table-striped" >
	 <thead>
	 <th> رقم الحالة</th>
	 <th> حالة المعيشة</th>
	 <th> المشكلة الحالية</th>
	 <th> حالة الطفل</th>
	 <th> تاريخ التحليل</th>
	 </thead>
	<tr>
	<td> <?php echo $AnalysisData['Case_id'] ; ?></td>
	<td> <?php echo $AnalysisData['Living_status_title'] ; ?></td>
	 <td> <?php echo $AnalysisData['Current_problem_title'] ; ?></td>
	<td> <?php echo $AnalysisData['Victim_state_title'] ; ?></td>
	 <td> <?php echo $AnalysisData['Created_date'] ; ?></td>
	</tr>
	
 
	 </table>
	 </div>
	 <?php if(!empty($AnalysisData['Other_issues'])){ ?>
<table class="table table-bordered table-striped" >
	 <thead>
	 <th>مشاكل اخرى </th>
	 
	 </thead>
	<tr>
	
	 <td> <?php echo $AnalysisData['Other_issues'] ; ?></td>
	
	</tr>
	
	</table><?php }
	} ?>
	 <div class="col-sm-5"><h3 class="small-line">  الإقتراحات</h3></div>
	  
	 
	 <div class="panel-body">
	 <table class="table table-bordered table-striped" >
	 <thead>
	 <th>الإجراء المقترح من قبل مدير الإحالة </th>
	 
	 </thead>
	<tr>
	
	 <td> <?php echo $AnalysisData['Suggested_prc_by_referral_manager'] ; ?></td>
	
	</tr>
	
	 </table>
	 </div>
	 	 
	 <div class="col-sm-5"><h3 class="small-line">  الخدمات المقترح تقديمها للحالة </h3></div>
	  
	 
	 <div class="panel-body">
	 <table class="table table-bordered table-striped" >
	 <thead>
	 <th> الخدمة المقترحة</th>
	  <th> نوع الخدمة</th>
	
	 </thead>
    <tbody>
	 <?php echo $Srvtbl; ?>
	</tbody>
	
	 </table>
	 </div>
	</div>
 </div>
</div>