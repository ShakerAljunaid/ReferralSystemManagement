<?php require_once('print_header.php');require_once('dbconfig.php');

$sql = "SELECT caseId, ChildFullName, ch.Gender, CareGiverFullName, CareGiverPhoneNo, ChildAddress, ca.RealServiceCount, ca.TimeServiceCount,ca.EchoServiceCount,ca.Final_decision,ca.Diagnose_state,ca.Iom_state,ca.Analysis_state,ca.analystName,ca.diagonistName,ca.IomAnalystName from  AllAboutCase AS ca INNER JOIN
childGridViewData AS ch ON ch.caseId=ca.ChildCaseId where caseId=".$_GET['ChildCaseId']; 
$ChildData = current($pdo->query($sql)->fetchAll());
 $sql = 'SELECT  * from  printchildcaseanalysis where Case_id='.$_GET['ChildCaseId'];
$AnalysisData = current($pdo->query($sql)->fetchAll());

$sql = "select cs.Case_id,cs.Service_id,cs.Quantity,case when cs.Start_date is null then now() else cs.Start_date end as Start_date  
  ,case when cs.End_date is null then now()  else cs.End_date end as End_date,cs.Service_state_id,s.Title ServiceTitle,s.Service_cat
  , case when cs.Service_id is null then 0 else 1 end as checkedState, CONCAT(u.First_name, ' ', u.Last_name) AS Service_giver_name
 from caseservice cs INNER JOIN service s  on (cs.Service_id=s.ID) INNER JOIN userview u ON (cs.Service_giver_id=u.ID)
 WHERE cs.Case_id=".$_GET['ChildCaseId'];
 
$Services=$pdo->query($sql)->fetchAll();
$sql="SELECT s.Title Service,sc.Title ServiceCategory,cn.Other_issues,cn.Case_id from case_analysis_suggested_services sgs
  join service s on sgs.Service_id=s.ID
  JOIN childcaseanalysis cn on cn.ID=sgs.Analysis_id
  join manylist sc on sc.ID=s.Service_cat and sc.List_type_id=4
  where cn.Case_id=".$_GET['ChildCaseId']; 
 $SgsServ= $pdo->query($sql)->fetchAll();
 $Srvtbl='';
 foreach($SgsServ as $sgs)
     $Srvtbl.= '<tr><td>'.$sgs['Service'].'</td><td>'.$sgs['ServiceCategory'].'</td></tr>';
	 
 
$sql = "SELECT   am.*,s.Title ServiceName,sc.Title as ServiceCat,concat(u.First_name,' ',u.Last_name) as activity_giver From activities_monitoring_data  am
  join caseservice cs on cs.ID=am.Case_service_id 
  join service s on cs.Service_id=s.ID 
  join manylist sc on sc.ID=s.Service_cat
  join userview u on u.ID=am.Created_user_id where am.case_id=".$_GET['ChildCaseId'];
 
$Activities=$pdo->query($sql)->fetchAll();
?>
<div class="container">   
 <div class="row" >
 <div class="col-sm-2"></div>
 <div class="col-sm-8">

	
	
	 <div class="col-sm-4"><h3 class="small-line">  بيانات الطفل الاساسية </h3></div>
	  
	
	
	 <div class="panel-body">
	 <table class="table table-bordered table-striped" >
	 <thead>
	 <th  data-field="caseId" >الرقم</th>
		<th data-field="ChildFullName"  >اسم الطفل</th>
		<th  data-field="Gender" >النوع</th>
		<th  data-field="CareGiverFullName" >مقدم الرعاية</th>
		<th  data-field="CareGiverPhoneNo" >رقم الهاتف</th>
		<th  data-field="ChildAddress" > العنوان</th>
		<th  data-field="RealServiceCount" > ع.الخدمات العينية</th>
	 <th  data-field="TimeServiceCount" > ع.الخدمات المزمنة</th>
	  <th   > الحالة</th>
	 </thead>
	<tr>
	<td> <?php echo $ChildData['caseId'] ; ?></td>
	<td> <?php echo $ChildData['ChildFullName'] ; ?></td>
	 <td> <?php echo $ChildData['Gender'] ; ?></td>
	<td> <?php echo $ChildData['CareGiverFullName'] ; ?></td>
	 <td> <?php echo $ChildData['CareGiverPhoneNo'] ; ?></td>
	 <td> <?php echo $ChildData['ChildAddress'] ; ?></td>
	 <td> <?php echo $ChildData['RealServiceCount'] ; ?></td>
	 <td> <?php echo $ChildData['TimeServiceCount'] ; ?></td>
	 <td> <?php echo $ChildData['Final_decision'] ; ?></td>
	</tr>
	
	 </table>
	 </div>
	 
	  <div class="col-sm-4"><h3 class="small-line">  بيانات الإحالة </h3></div>
	  <div class="panel-body">
	 <table class="table table-bordered table-striped" >
	   <thead>
    	  <th>المسؤول</th>
		  <th>الحالة</th>
		   <th>اسم الشخص</th>
		</thead>
		<tbody>
		<tr>
		  <td>الاجتماعي</td>
		   <td><?php echo $ChildData['Analysis_state'] ; ?></td>
		     <td><?php echo $ChildData['analystName'] ; ?></td>
		</tr>
		<tr>
		  <td>النفسي</td>
		  <td><?php echo $ChildData['Diagnose_state'] ; ?></td>
		    <td><?php echo $ChildData['diagonistName'] ; ?></td>
		
		</tr>
		<tr>
		  <td>الـIOM</td>
		   <td><?php echo $ChildData['Iom_state'] ; ?></td>
		     <td><?php echo $ChildData['IomAnalystName'] ; ?></td>
		</tr>
		</tbody>
		 
		
		 
	 
	
	 </table>
	 </div>
	 	<?php //if($UserType!=524){?>	
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
	//} ?>
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
	<?php if($ChildData['RealServiceCount'] > 0){ ?>
 <div class="col-sm-4"><h3 class="small-line">  الخدمات العينية</h3></div>
	  
	
	
	 <div class="panel-body">
	 <table class="table table-bordered table-striped" >
	 <thead>
	 <th  data-field="ServiceTitle" >	مساعدات طبية</th>
		<th data-field="Start_date"  >تاريخ تقديم الخدمة</th>
	 </thead>
  <?php foreach($Services as $srv){ 
          if($srv['Service_cat']==380){
     ?>
	<tr>
	<td> <?php echo $srv['ServiceTitle'] ; ?></td>
	<td> <?php echo date('Y-m-d',strtotime($srv['Start_date'])) ; ?></td>
	</tr>
	<?php }} ?>
	 </table>
	 </div>
 <?php } ?>
 
 <?php if($ChildData['TimeServiceCount'] > 0){ ?>
 <div class="col-sm-4"><h3 class="small-line">  دعم نفسي اجتماعي</h3></div>
	  
	
	
	 <div class="panel-body">
	 <table class="table table-bordered table-striped" >
	 <thead>
	 <th  >	اسم الخدمة</th>
		<th  >تاريخ البدء</th>
   <th   >		تاريخ الانتهاء</th>
		<th  >	الشخص المسؤول</th>
			<th   >	التقرير</th>
	 </thead>
  <?php foreach($Services as $srv){ 
          if($srv['Service_cat']==381){
     ?>
	<tr>
	<td> <?php echo $srv['ServiceTitle'] ; ?></td>
	<td> <?php echo  date('Y-m-d',strtotime($srv['Start_date'])) ; ?></td>
  <td> <?php echo date('Y-m-d',strtotime($srv['End_date'])) ; ?></td>
	<td> <?php echo  $srv['Service_giver_name'] ; ?></td>
	<?php if($srv['Service_id'] ==10){ ?>
	<td> 
	<a class="like "  title="Like" href="diagnose_data_print.php?Case_No=<?php echo $srv['Case_id']; ?>" target="_blank" >
        <i class="fa fa-print hidden-print"></i> <span class="label label-primary">التقرير النفسي</span>
        </a>
	</td>
	</tr>
  <?php }}} ?>
	 </table>
	 </div>
 <?php } ?>
  <?php if($ChildData['EchoServiceCount'] > 0){ ?>
 <div class="col-sm-4"><h3 class="small-line">  دعم نفسي اقتصادي</h3></div>
	  
	
	
	 <div class="panel-body">
	 <table class="table table-bordered table-striped" >
	 <thead>
	 <th  data-field="ServiceTitle" >	اسم الخدمة</th>
		<th data-field="Start_date"  >تاريخ البدء</th>
   <th  data-field="End_date" >		تاريخ الانتهاء</th>
		<th data-field="Service_giver_name"  >	الشخص المسؤول</th>
	 </thead>
  <?php foreach($Services as $srv){ 
          if($srv['Service_cat']==471){
     ?>
	<tr>
	<td> <?php echo $srv['ServiceTitle'] ; ?></td>
	<td> <?php echo  date('Y-m-d',strtotime($srv['Start_date'])) ; ?></td>
  <td> <?php echo date('Y-m-d',strtotime($srv['End_date'])) ; ?></td>
	<td> <?php echo  $srv['Service_giver_name'] ; ?></td>
	</tr>
	<?php }} ?>
	 </table>
	 </div>
 <?php } ?>
 
  <div class="col-sm-2"><h3 class="small-line">  الانشطة</h3></div>
	  
	
	
	 <div class="panel-body">
	 <table class="table table-bordered table-striped" >
	 <thead>
	   <th  >	نوع الخدمة</th>
	     <th >اسم الخدمة</th>
	  <th  >	النشاط</th>
		<th  >التاريخ</th>
    
     <th   >	التقييم</th>
     <th >ملاحظات</th>
	  <th >مقدم النشاط</th>
	 </thead>
  <?php foreach($Activities as $act){ 
     ?>
	<tr>
	<td> <?php echo $act['ServiceCat'] ; ?></td>
	<td> <?php echo $act['ServiceName'] ; ?></td>
	<td> <?php echo $act['Title'] ; ?></td>
	<td> <?php echo date('Y-m-d',strtotime($act['Day_date'])) ; ?></td>
   
    <td><?php echo $act['Rate_name'] ; ?></td>
    <td> <?php echo $act['Notes']; ?></td>
	 <td> <?php echo $act['activity_giver']; ?></td>
	</tr>
	<?php } ?>
	 </table>
	 </div>
 
	</div>
 </div>
</div>