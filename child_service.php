<?php 
require_once('header-links.php');
//require_once('RetrieveData2Javascript/retrieve_cmb_data.php');
   $sql = 'SELECT  * from  case_service_view'; 
$ChildServiceData = $pdo->query($sql)->fetchAll();
echo '<script> var JsChildServiceData='.json_encode($ChildServiceData).';var userId='.$UserId.'; </script>';

?>
<link rel='stylesheet' href='GrdExp/css/bootstrap-table.min.css'>
<link rel='stylesheet' href='GrdExp/css/bootstrap-editable.css'>
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
										<h2 id="CurrentScreen">تقديم الخدمات</h2>
										<p id="CurrentScreenDescription">بعد إتمام التشخيص المبدئي والتحليل النفسي يتم اسناد الخدمات المذكورة فيهما في هذه الشاشة</p>
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
    
    <br />
	<div  class="col-md-2"></div>
	<div class="col-md-8" >
	<table class="table table-bordered table-hover table-striped" data-toggle="table"  data-search="true"
			 data-filter-control="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar"
			  data-show-pagination-switch="true" data-pagination="true" data-id-field="ID" data-page-size="50"  data-side-pagination="client"
            class="table-responsive" id="CaseServiceGrid">
	   
										<thead>
									
                                                <tr>
												    <th  data-field="ChildCaseId" data-width="3%" data-filter-control="input" data-sortable="true">الرقم</th>
													<th  data-field="FullName" data-filter-control="input" data-sortable="true">اسم الطفل</th>
													<th  data-field="Gender" data-filter-control="select" data-sortable="true">النوع</th>
													<th  data-field="Address" data-filter-control="input" data-sortable="true">المحافظة -المديرية</th>
													<th  data-field="RealServiceCount" data-filter-control="input" data-sortable="true">ع.مساعدات طبية</th>
													<th  data-field="TimeServiceCount" data-filter-control="input" data-sortable="true">ع.دعم نفسي اجتماعي</th>
													<th data-formatter="RealServiceFormatter" >مساعدات طبية</th>
													<th data-formatter="EchnomicBoundServiceFormatter" >دعم نفسي اقتصادي</th>
													<th data-formatter="TimeBoundServiceFormatter" >دعم نفسي اجتماعي</th>
													<th data-formatter="PrintFormatter" >طباعة</th>
												
											

												</tr>
                                            </thead>
                                             <tbody >
											
											 </tbody>
                                        </table>
  
</div>

<!-- Modal -->
<div class="modal fade" id="ServiceModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog " style="width:60%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">الخدمات</h4>
            </div>
            <div class="modal-body">
                <form data-toggle="validator" role="form" id="frm_service">
                    <table class="table table-hover table-inbox" id="tblServices">
                                
                      </table>
				</form>
             </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                <button type="button" id="btnSaveService" class="btn btn-primary">حفظ</button>
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

<script>

$(document).ready(function(e){
	//Fill data
	var t=$("#CaseServiceGrid").bootstrapTable('destroy');
	
 t.bootstrapTable({ data:JsChildServiceData}); 
	
});
function showServiceModal(CaseId,ServiceCat)
{ 

$.post('AjaxFiles/AjaxRetrieveAllServices',{Case_Id:CaseId,Service_Cat_Id:ServiceCat},function(r){
	   let res=r.split('Delemiter');
	 $('#tblServices').html(res[0]);
		
	  $('.ServiceRow').each(function(k,i){
		 let currenrRow=$(this);
		 if($('.checkService').eq(k).is(":checked") )
		    currenrRow.find('input:not(:checkbox),select').attr('disabled',false);
	        else 
		    currenrRow.find('input:not(:checkbox),select').attr('disabled',true);
	 });
	 
	 $('.ServiceRow').each(function(k,i){
		let currenrRow=$(this);
		currenrRow.on('change',function(e)
		{
		if($('.checkService').eq(k).is(":checked") )
		currenrRow.find('input:not(:checkbox),select').attr('disabled',false);
	       else 
		   currenrRow.find('input:not(:checkbox),select').attr('disabled',true);
		});
		
	});
	$('.cntState').prop("disabled",true);
	$('#ServiceModal').modal('show');
});
 	 
$('#btnSaveService').off('click').on('click',function(e){
	
	//alert(CaseId);
let CheckedService=[];
let UnCheckedService=[];
		$('.ServiceRow').each(function(k,i){
		 let currenrRow=$(this);
		 if($('.checkService').eq(k).is(":checked") )
		    CheckedService.push({"ServiceId":$('input[name="ServiceId"]').eq(k).val() ,"StartingDate":setDefaultDate($('input[name="Service_starting_date"]').eq(k).val()),"EndingDate":setDefaultDate($('input[name="Service_end_date"]').eq(k).val()), "Quantity":1,"ServiceState":1 ,"ResponsiblePerson":setDefaultUser($('.ResbonsiblePersonId').eq(k).val())})
	     else 
			UnCheckedService.push($('input[name="ServiceId"]').eq(k).val());
	     
	   });
	  
		$.post("AjaxFiles/AjaxSaveCaseService.php",{checkedServices:CheckedService,uncheckedServices:UnCheckedService,childCaseId:CaseId},function(r){
			console.log(r);
			
			$('#ServiceModal').modal('hide');
		});
		
		
	});
	
	
}


function RealServiceFormatter(value, row, index) {
	 return [
        '<a class="like btnEditAgency"  title="Like" onclick=showServiceModal('+row.ChildCaseId+',380)>',
        '<i class="fa fa-edit"></i> <span class="label label-primary">مساعدات طبية</span>',
        '</a>'
		
        
    ].join('');
	
   
}

function TimeBoundServiceFormatter(value, row, index) {
	return [
        '<a class="like btnEditAgency"  title="Like" onclick=showServiceModal('+row.ChildCaseId+',381)>',
        '<i class="fa fa-edit"></i> <span class="label label-primary">دعم نفسي اجتماعي</span>',
        '</a>'
		
        
    ].join('');
	
}
function EchnomicBoundServiceFormatter(value, row, index) {
	return [
        '<a class="like btnEditAgency"  title="Like" onclick=showServiceModal('+row.ChildCaseId+',471)>',
        '<i class="fa fa-edit"></i> <span class="label label-primary">دعم نفسي إقتصادي</span>',
        '</a>'
		
        
    ].join('');
	
}
function PrintFormatter(value, row, index)
{return [
        '<a class="like "  title="Like" href="child_services_data_print.php?ChildCaseId='+row.ChildCaseId+'" target="_blank" >',
        '<i class="fa fa-print"></i> <span class="label label-primary">طباعة</span>',
        '</a>'
		
        
    ].join('');
	
}
var setDefaultDate=function(param)
{
	if(!param)
		param=new Date().toISOString().slice(0, 10);
	return param;
}


var setDefaultUser=function(param)
{
	if(!param)
		/*Temporary Hussam*/
		param=17;
	return param;
}


</script>