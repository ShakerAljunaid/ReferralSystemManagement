<?php 
require_once('header-links.php');

$sql =  "SELECT ID,Title, List_type_id  FROM manylist where List_type_id =18; ";
$ManyListData=$pdo->query($sql)->fetchAll();
$RateData='';
$PeriodData='';
foreach ($ManyListData as $md)
{
	$RateData.='<option value='.$md['ID'].' >'.$md['Title'].'</option>'; 
	
}
echo '<script> var jsRateData="'.$RateData.'";</script>'; 
?>
<link rel='stylesheet' href='GrdExp/css/bootstrap-table.min.css'>
<link rel='stylesheet' href='GrdExp/css/bootstrap-editable.css'>
<div class="CaseClose-fluid fill">
   <br />
    <div class="row">
	<div  class="col-md-2"></div>
	
        <div class="col-md-2 compose-ml">
		
            
        </div>
       
    </div>
    <br />
	<div  class="col-md-2"></div>
	<div class="col-md-8" >
	<table class="table table-bordered table-hover table-striped" data-toggle="table"  data-search="true"
			 data-filter-control="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar"
			  data-show-pagination-switch="true" data-pagination="true" data-id-field="ID" data-page-size="50"  data-side-pagination="client"
            class="table-responsive" id="CaseCloseGrid">
	   
										<thead>
									
                                                <tr>
												    <th  data-field="caseId" data-width="3%" data-filter-control="input" data-sortable="true">الرقم</th>
													<th data-field="ChildFullName" data-filter-control="input" data-sortable="true" >اسم الطفل</th>
                                                    <th  data-field="Gender" data-filter-control="select" data-sortable="true" >النوع</th>
													<th  data-field="CareGiverFullName" data-filter-control="input" data-sortable="true">اسم المُعتني</th>
													<th  data-field="CareGiverPhoneNo" data-filter-control="input" data-sortable="true">رقم الهاتف</th>
													<th  data-field="ChildAddress" data-filter-control="input" data-sortable="true"> العنوان</th>
													<th  data-field="ParentState" data-filter-control="select" data-sortable="true"> حالة الوالدين</th>
													<th  data-field="Close_status_title" data-filter-control="select" data-sortable="true">الحالة</th>
													<th  data-field="Status_date" data-filter-control="input" data-sortable="true">التاريخ</th>
													<th  data-field="Status_reason" data-filter-control="input" data-sortable="true">الوصف</th>
													<th data-formatter="EditCaseCloseFormatter" >تغيير</th>
													

												</tr>
                                            </thead>
                                             <tbody id="TblRequestsBody">
											
											 </tbody>
                                        </table>
  
</div>

<!-- Modal -->
<div class="modal fade" id="CaseCloseFormModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">تغيير الحالة</h4>
            </div>
            <div class="modal-body">
                <form data-toggle="validator" role="form" id="frm_CaseClose">
                    <input type="hidden" id="CaseClose_ID" name="CaseClose_ID" value="0" />
					<input type="hidden" id="CaseClose_Case_ID" name="CaseClose_Case_ID" value="0" />
					<div class="form-group"> <label for="Customer_id">الحالة<span class="rqd">*</span> :</label><select class="form-control" id="CaseClose_status" name="CaseClose_status" readonly='true'  required>
												<option value="1">مغلقة</option>
                                                <option value="0">إعادة فتح</option></select></div>
					<div class="form-group"> <label for="ContractId">الوصف<span class="rqd">*</span> :</label><input type="text" class="form-control" id="CaseClose_reason" name="CaseClose_reason"  required></div>
                </form>
             </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                <button type="button" id="btnSave" class="btn btn-primary">حفظ</button>
            </div>
        </div>
    </div>
</div>
</div>

<?php require_once('footer-links.php');?>
	<script>
		$( "#masters-page" ).addClass( "active" );
		$( "#Forms" ).addClass( "active" );
	</script>
<script src='GrdExp/js/bootstrap-table.js'></script>
<script src='GrdExp/js/bootstrap-table-editable.js'></script>
<script src='GrdExp/js/bootstrap-table-export.js'></script>
<script src='GrdExp/js/tableExport.js'></script>
<script src='GrdExp/js/bootstrap-table-filter-control.js'></script>

<script>

$(document).ready(function(e){
	$('#s_CaseClose_cat').html(jsRateData);
	var returnJsonCaseCloseArray=[];
	//var CurrentRowIndex=0;
    // jQuery.fn.bootstrapTable.defaults.escape=false;
     
	$.get("AjaxFiles/AjaxRetrieveCaseCloses.php",function(r){
		//console.log(r);
		 refereshTable(r);
	});
    
	     
	
	//,CustomerId,
	/*Events */
	   /*$('#btnAddNewCaseClose').on('click',function(e){
		$('#CaseClose_ID').val(0);
		$('#CaseClose_ID').val(0);
		$('#frm_CaseClose').trigger("reset");;
		$('#CaseCloseFormModal').modal('show');
		
	});*/
	$('#btnSave').on('click',function(e){
		
		data = $('#frm_CaseClose').serializeArray();
		console.log(data);
		//data.push({"name":"ContractId","value":ContractId});
		$.post("AjaxFiles/AjaxEditCaseClose.php",data,function(r){ $('#CaseCloseFormModal').modal('hide');
		
		  		 refereshTable(r);
		});
		
		
	});
	
	
	
	
});
function refereshTable(JsonArray)
{  

 var t=$("#CaseCloseGrid").bootstrapTable('destroy');
 t.bootstrapTable({ data:JSON.parse(JsonArray)});
	returnJsonCaseCloseArray=JSON.parse(JsonArray);
	$('.btnEditCaseClose').each(function(k,i){
		$(this).on('click',function(e){
		currentRow = returnJsonCaseCloseArray[k];
		if(currentRow.Close_status_opsite == 1)
			$('#myModalLabel').val('إغلاق الحالة');
		else
			$('#myModalLabel').val('إعادة فتح الحالة');
		$('#CaseClose_ID').val(currentRow.Close_id);
		$('#CaseClose_Case_ID').val(currentRow.caseId);
       $('#CaseClose_status').val(currentRow.Close_status_opsite),
       $('#CaseClose_reason').val(''),
	    $('#CaseCloseFormModal').modal('show');							
		
	});
});
	
}

function EditCaseCloseFormatter(value, row, index) {
	 return [
        '<a class="like btnEditCaseClose"  title="Like">',
        '<i class="fa fa-edit"></i> <span class="label label-primary">تعديل</span>',
        '</a>'
		
        
    ].join('');
	
   
}



</script>