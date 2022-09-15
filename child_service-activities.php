<?php 
require_once('header-links.php');
$sql = 'SELECT  * from  children_with_timed_service';
 if($UserType!=436){
    $sql .=' where Service_giver_id='.$UserId;
    if($UserType==433)
		$sql .=' and ServiceId=10;';
 }
   
  
$ChildCaseServiceData = $pdo->query($sql)->fetchAll();
echo '<script>var currentQuery="'.$sql.'"; var JsChildCaseServiceData='.json_encode($ChildCaseServiceData).'; </script>';
$sql =  "SELECT ID,Title, List_type_id  FROM manylist where List_type_id in(14,6); ";
$ManyListData=$pdo->query($sql)->fetchAll();
$RateData='';
$PeriodData='';
foreach ($ManyListData as $md)
{
	if($md['List_type_id']==14)
		$RateData.='<option value='.$md['ID'].' >'.$md['Title'].'</option>'; 
	else
		$PeriodData.='<option value='.$md['ID'].' >'.$md['Title'].'</option>'; 
	
}
$sql =  "select * from userview  where User_type_id=442";
$Activitors=$pdo->query($sql)->fetchAll();
$ActivitorsStr='';
foreach($Activitors as $ac)
$ActivitorsStr .='<option value='.$ac['ID'].'>'.$ac['First_name'].' '.$ac['Last_name'].'</option>';
echo '<script> var jsRateData="'.$RateData.'";var jsPeriodData="'.$PeriodData.'";var jsActivitors="'.$ActivitorsStr.'";</script>'; 
            

?>
<link rel='stylesheet' href='GrdExp/css/bootstrap-table.min.css'>
<link rel='stylesheet' href='GrdExp/css/bootstrap-editable.css'>
 <link href="css/bootstrap-multiselect.css"  rel="stylesheet" type="text/css" />
<div class="Agency-fluid fill">
   <br />
   <div class="breadcomb-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
					<div class="breadcomb-list">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="breadcomb-wp">
									<div class="breadcomb-icon">
										<i class="notika-icon notika-support"></i>
									</div>
									<div class="breadcomb-ctn ">
										<h2 id="CurrentScreen">مراقبة النشاطات</h2>
										<p id="CurrentScreenDescription">لمراقبة تقدم الاطفال ذو الاحتياجات النفسية يتم ادخال وتقييم نشاطتهم اليومية من خلال هذه الشاشة.</p>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
								<div class="breadcomb-report">
									<button data-toggle="tooltip" data-placement="left" title="Download Report" class="btn"><i class="notika-icon notika-sent"></i></button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
  
	<div  class="col-md-2"></div>
	<div class="col-md-8" >
	<table class="table table-bordered table-hover table-striped" data-toggle="table"  data-search="true"
			 data-filter-control="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar"
			  data-show-pagination-switch="true" data-pagination="true" data-id-field="ID" data-page-size="50"  data-side-pagination="client"
            class="table-responsive" id="tblCaseServiceGrid">
	   
										<thead>
									
                                                <tr>
												     <th  data-field="CaseServiceId" data-width="3%" data-filter-control="input" data-sortable="true">الرقم</th>
												    <th  data-field="Child_id" data-width="3%" data-filter-control="input" data-sortable="true">الرقم</th>
													<th  data-field="FullName" data-filter-control="input" data-sortable="true">اسم الطفل</th>
													<th  data-field="Gender" data-filter-control="select" data-sortable="true">النوع</th>
													<th  data-field="Age" data-filter-control="input" data-sortable="true">العمر</th>
													 <th  data-field="DisplacedState" data-filter-control="select" data-sortable="true">نازح؟</th>
													<th  data-field="Title" data-filter-control="select" data-sortable="true">اسم الخدمة</th>
													<th  data-field="Start_date" data-filter-control="input" data-sortable="true">تاريخ البدء</th>
													<!--<th  data-field="TimeServiceCount" data-filter-control="input" data-sortable="true">ع.الخدمات المزمنة</th>
													<th data-formatter="RealServiceFormatter" >الخدمات العينية</th>-->
													
													<th data-formatter="ActivityMonitoringFormatter" >الأنشطة</th>
													
													<?php if($UserType==523 || $UserType==436 ) {?>
													<th data-formatter="AssignMonitoringFormatter" >تعين منشط مساحة</th>
													<?php } ?>
													<th data-formatter="PrintFormatter" >طباعة</th>
													

												</tr>
                                            </thead>
                                             <tbody >
											
											 </tbody>
                                        </table>
  
</div>

<!-- Modal -->
<div class="modal fade" id="ActivityMonitoringModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog " style="width:70%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">الأنشطة</h4>
            </div>
            <div class="modal-body">
                <form data-toggle="validator" role="form" id="frm_monitoringData">
                    <table class="table table-bordered table-striped" >
					   <thead>
					   <tr> 
					   <th style="width:8%"  >*</th>
					   <th style="width:3%" class="hidden">الرقم</th>
					    <th style="width:12%">النشاط</th>
						 <th style="width:2%">التاريخ</th>
						     <th style="width:10%">التقييم</th>
							<th style="width:18%">ملاحظات</th>
					   </tr>
					  
					   </thead>
					    <tbody>
						<tr>
						<td><button type="button" value="" class="btn btn-primary" id="btnSaveMonitorData" name="btnSaveMonitorData" >حفظ</button></td>
						 <td  class="hidden" ><input class="form-control" id="nmCaseServId" name="nmCaseServId" type="number"  value=0 > </td>
						<td  class="hidden" ><input class="form-control" id="nmId" name="nmId" type="number"  value=0 > </td>
						 <td  ><select class="form-control mltSlc" id="slcActivitiesOfSrv"  multiple="multiple" ></select> </td>
						 <td><input class="form-control" id="dtCurrentDate" name="dtCurrentDate"  type="date" ></td>
					
						 <td><select class="form-control" id="slcRateId" name="slcRateId" ></select> </td>
						 <td><input class="form-control" id="txtComment" name="txtComment" type="text" > </td>
						  
						</tr>
					   </tbody>
					</table>
				  
					
			    </form>
				<table class="table table-bordered table-hover table-striped" data-toggle="table"  data-search="true"
			 data-filter-control="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar"
			  data-show-pagination-switch="true" data-pagination="true" data-id-field="ID" data-page-size="10"  data-side-pagination="client"
            class="table-responsive" id="tblRegAtctivities">
	   
										<thead>
									
                                                <tr>
												    <th  data-field="ID" data-width="3%" data-filter-control="input" data-sortable="true">الرقم</th>
													<th  data-field="Title" data-filter-control="input" data-sortable="true">النشاط</th>
													<th  data-field="Day_date" data-filter-control="select" data-sortable="true">التاريخ</th>
													<th  data-field="Rate_name" data-filter-control="input" data-sortable="true">التقييم</th>
													<th  data-field="Notes" data-filter-control="input" data-sortable="true">ملاحظات</th>
													<th data-formatter="EditMonitoringFormatter" >تعديل</th>
												</tr>
                                            </thead>
                                             <tbody >
											
											 </tbody>
                                        </table>
  
             </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                <button type="button" id="btnSave" class="btn btn-primary">حفظ</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="AssignMonitoringModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">منشطين المساحة</h4>
            </div>
            <div class="modal-body">
			<label id='CaseId' class="hidden"></label>
             <select class="form-control" id="SpaceActivitors" ></select>
  
             </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                <button type="button" id="btnSetActivitor" class="btn btn-primary">حفظ</button>
            </div>
        </div>
    </div>
</div>
</div>

<?php require_once('footer-links.php');?>

<script src='GrdExp/js/bootstrap-table.js'></script>
<script src='GrdExp/js/bootstrap-table-editable.js'></script>
<script src='GrdExp/js/bootstrap-table-export.js'></script>
<script src='GrdExp/js/tableExport.js'></script>
<script src='GrdExp/js/bootstrap-table-filter-control.js'></script>
 <script src="js/bootstrap-multiselect.min.js" type="text/javascript"></script>
<script>
var currentCaseId=0;
$(document).ready(function(e){
	$('#slcRateId').html(jsRateData);
	$('#slcPeriodId').html(jsPeriodData);

	//Fill data
	var t=$("#tblCaseServiceGrid").bootstrapTable('destroy');
    t.bootstrapTable({ data:JsChildCaseServiceData}); 
	$('#btnSaveMonitorData').on('click',function(e){
		
		var actVal='';
		$('#slcActivitiesOfSrv option:selected').each(function (key, element) {
                        if (key < ($('#slcActivitiesOfSrv option:selected').length - 1))
                            actVal += $(this).val() + ','
                        else
                            actVal += $(this).val()
                    })
		 let actfrmdata=$('#frm_monitoringData').serializeArray();	
			actfrmdata.push({name:"slcAct",value:actVal});	console.log(actfrmdata);	
		$.post("AjaxFiles/AjaxSaveActivityMonitoring.php",actfrmdata,function(r){
			console.log(r);
			let t=$("#tblRegAtctivities").bootstrapTable('destroy');
		         CurrentCaseRegActivities=JSON.parse(r);
				 t.bootstrapTable({ data:JSON.parse(r)});
				resetActivitiesForm();
				

		 });
	});
	
	$('#btnSetActivitor').on('click',function(e){

		$.post('AjaxFiles/AjaxAssignServiceGiver.php',{CaseId:$('#CaseId').html(),ActivitorId:$('#SpaceActivitors').val(),Qry:currentQuery},function(r){
	    	var t=$("#tblCaseServiceGrid").bootstrapTable('destroy');
             t.bootstrapTable({ data:JSON.parse(r)}); 
		
			 $('#AssignMonitoringModal').modal('hide');
		
	});
});	
	
});
function showMonitoringModal(caseserviceid,serviceId)
{  $.post('AjaxFiles/AjaxRetrieveActivityMonitoring.php',{CaseServiceId:caseserviceid,ServiceId:serviceId},function(r){
	    let t=$("#tblRegAtctivities").bootstrapTable('destroy');
		console.log(r);
		CurrentCaseRegActivities=JSON.parse(r).RegistredActivities;
				 t.bootstrapTable({ data:JSON.parse(r).RegistredActivities}); 
		      $('#slcActivitiesOfSrv').html(JSON.parse(r).ServiceActivities).multiselect({   includeSelectAllOption: true})
			 
			  $('#nmCaseServId').val(caseserviceid);
			  resetActivitiesForm();
		$('#ActivityMonitoringModal').modal('show');
	});
	
 
	
}
function resetActivitiesForm(){
	$('#slcActivitiesOfSrv').multiselect('deselectAll', false);    
$('#slcActivitiesOfSrv').multiselect('updateButtonText');
$('#txtComment').val(''),$('#dtCurrentDate').val(setDefaultDate(''));	
	
}
function setEditingDataRow(MonitoringRowId)
{
	$.each(CurrentCaseRegActivities,function(k,i)
	{
		if(i.ID==MonitoringRowId)
		{$('#nmId').val(i.ID),$('#nmCaseServId').val(i.Case_service_id),$('#slcActivitiesOfSrv').val(i.Case_activity_id),
	      $('#dtCurrentDate').val(i.Day_date),$('#nmPeriodNo').val(i.Spend_period_No),$('#slcPeriodId').val(i.Spend_period_id),
			 $('#slcRateId').val(i.Rate_id), $('#txtComment').val(i.Notes)
		}
		
	});
	
}

function ActivityMonitoringFormatter(value, row, index) {
	 return [
        '<a class="like btnEditAgency"  title="Like" onclick=showMonitoringModal('+row.CaseServiceId+','+row.ServiceId+')>',
        '<i class="fa fa-edit"></i> <span class="label label-primary">الأنشطة</span>',
        '</a>'
		
        
    ].join('');
	
   
}

function EditMonitoringFormatter(value, row, index)
{
	return [
        '<a class="like btnEditAgency"  title="Like" onclick=deleteActivity('+row.ID+','+index+')>',
        '<i class="fa fa-trash"></i> <span class="label label-danger">حذف</span>',
        '</a>'
	    ].join('');
	
}
function PrintFormatter(value, row, index)
{
	return [
        '<a class="like btnEditAgency"  title="Like" href="child_activities_data_print.php?CaseId='+row.CaseServiceId+'" target="_blank">',
        '<i class="fa fa-print"></i> <span class="label label-primary">طباعة</span>',
        '</a>'
	    ].join('');
	
}


function showActivitorsModal(ServicGiverId,ChosenCaseId)

{
	$('#CaseId').html(ChosenCaseId);
 $('#SpaceActivitors').html(jsActivitors).val(ServicGiverId);
 $('#AssignMonitoringModal').modal('show');
 
}
function AssignMonitoringFormatter(value, row, index)
{
	return [
        '<a class="like btnEditAgency"  title="Like" onclick=showActivitorsModal('+row.Service_giver_id+','+row.Case_id+')>',
        '<i class="fa fa-print"></i> <span class="label label-primary">تعين منشط</span>',
        '</a>'
	    ].join('');
	
}

var setDefaultDate=function(param)
{
	if(!param)
		param=new Date().toISOString().slice(0, 10);
	return param;
}
function deleteActivity(Id,index)
{
	$.post('AjaxFiles/AjaxDeleteActivity.php',{RowId:Id},function(r){
		console.log(r);
	    $('#tblRegAtctivities [data-index='+index+']').remove();
		
	});
}

</script>