<?php require_once('print_header.php');require_once('dbconfig.php');

$sql = "SELECT caseId, ChildFullName, ch.Gender, CareGiverFullName, CareGiverPhoneNo, ChildAddress, ca.RealServiceCount, ca.TimeServiceCount,ca.EchoServiceCount from  case_service_view AS ca INNER JOIN
childGridViewData AS ch ON ch.caseId=ca.ChildCaseId where caseId=".$_GET['ChildCaseId']; 
$ChildData = current($pdo->query($sql)->fetchAll());
 
$sql = "select cs.Case_id
  ,cs.Service_id
  ,cs.Quantity
  ,case when cs.Start_date is null then now() else cs.Start_date end as Start_date  
  ,case when cs.End_date is null then now()  else cs.End_date end as End_date
  ,cs.Service_state_id
  ,s.Title ServiceTitle
  ,s.Service_cat
  , case when cs.Service_id is null then 0 else 1 end as checkedState, CONCAT(u.First_name, ' ', u.Last_name) AS Service_giver_name
 from caseservice cs INNER JOIN service s  on (cs.Service_id=s.ID) INNER JOIN userview u ON (cs.Service_giver_id=u.ID)
 WHERE cs.Case_id=".$_GET['ChildCaseId'];
 
$Services=$pdo->query($sql)->fetchAll();
/*$RealServices=[];
$TimedServices=[];
foreach($Services as $srv){
  if($srv['Service_cat']==380)
	{ 
	  array_push( $RealServices,  $srv);
	}else{
    array_push( $TimedServices,  $srv);
  }
}

echo $TimedServices;*/
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
	</tr>
	
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
	 <th  data-field="ServiceTitle" >	اسم الخدمة</th>
		<th data-field="Start_date"  >تاريخ البدء</th>
   <th  data-field="End_date" >		تاريخ الانتهاء</th>
		<th data-field="Service_giver_name"  >	الشخص المسؤول</th>
	 </thead>
  <?php foreach($Services as $srv){ 
          if($srv['Service_cat']==381){
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
 
	</div>
 </div>
</div>