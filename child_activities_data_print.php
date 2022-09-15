<?php require_once('print_header.php');require_once('dbconfig.php');

$sql = "SELECT ch.caseId, ChildFullName, ch.Gender,ch.Age, CareGiverFullName, CareGiverPhoneNo, ChildAddress, s.Title ServiceTitle
  ,case when cs.Start_date is null then now() else cs.Start_date end as Start_date  
  ,case when cs.End_date is null then now()  else cs.End_date end as End_date
  ,cs.Service_state_id
  , case when cs.Service_id is null then 0 else 1 end as checkedState, CONCAT(u.First_name, ' ', u.Last_name) AS Service_giver_name
  from  childGridViewData AS ch INNER JOIN
  caseservice cs ON ch.caseId = cs.Case_id INNER JOIN service s  on (cs.Service_id=s.ID) INNER JOIN userview u ON (cs.Service_giver_id=u.ID)
  where cs.ID=".$_GET['CaseId']; 
$ChildData = current($pdo->query($sql)->fetchAll());
 
$sql = "SELECT   * From activities_monitoring_data where Case_service_id=".$_GET['CaseId'];
 
$Services=$pdo->query($sql)->fetchAll();

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
		<th  data-field="Age" >العمر</th>
		<th  data-field="CareGiverFullName" >مقدم الرعاية</th>
		<th  data-field="CareGiverPhoneNo" >رقم الهاتف</th>
		<th  data-field="ChildAddress" > العنوان</th>
	 </thead>
	<tr>
	<td> <?php echo $ChildData['caseId'] ; ?></td>
	<td> <?php echo $ChildData['ChildFullName'] ; ?></td>
	 <td> <?php echo $ChildData['Gender'] ; ?></td>
	  <td> <?php echo $ChildData['Age'] ; ?></td>
	<td> <?php echo $ChildData['CareGiverFullName'] ; ?></td>
	 <td> <?php echo $ChildData['CareGiverPhoneNo'] ; ?></td>
	 <td> <?php echo $ChildData['ChildAddress'] ; ?></td>
	</tr>
	
	 </table>
	 </div>
   <div class="col-sm-3">
     <h3 class="small-line">  بيانات الخدمة </h3>
   </div>



   <div class="panel-body">
     <table class="table table-bordered table-striped" >
       <thead>
         <th  data-field="caseId" >اسم الخدمة</th>
         <th data-field="ChildFullName"  >تاريخ البداية</th>
         <th  data-field="Gender" >تاريخ الانتهاء</th>
         <th  data-field="CareGiverFullName" >مقدم الرعاية</th>
       </thead>
       <tr>
         <td>
           <?php echo $ChildData['ServiceTitle'] ; ?>
         </td>
         <td>
           <?php echo date('Y-m-d',strtotime($ChildData['Start_date'])) ; ?>
         </td>
         <td>
           <?php echo date('Y-m-d',strtotime($ChildData['End_date'])); ?>
         </td>
         <td>
           <?php echo $ChildData['CareGiverFullName'] ; ?>
         </td>
       </tr>

     </table>
   </div>
   
	
 <div class="col-sm-2"><h3 class="small-line">  الانشطة</h3></div>
	  
	
	
	 <div class="panel-body">
	 <table class="table table-bordered table-striped" >
	 <thead>
	  <th  data-field="ServiceTitle" >	النشاط</th>
		<th data-field="Start_date"  >التاريخ</th>
    
     <th  data-field="ServiceTitle" >	التقييم</th>
     <th data-field="Start_date"  >ملاحظات</th>
	 </thead>
  <?php foreach($Services as $srv){ 
     ?>
	<tr>
	<td> <?php echo $srv['Title'] ; ?></td>
	<td> <?php echo date('Y-m-d',strtotime($srv['Day_date'])) ; ?></td>
   
    <td><?php echo $srv['Rate_name'] ; ?></td>
    <td> <?php echo $srv['Notes']; ?></td>
	</tr>
	<?php } ?>
	 </table>
	 </div>
 
	</div>
 </div>
</div>