<?php 
require_once('header-links.php');
  $sql = 'SELECT  ID,Title from  service where Service_cat=381'; 
$ServiceData = $pdo->query($sql)->fetchAll();
$ServiceOptions='';
foreach ($ServiceData as $sr)
 $ServiceOptions.='<option value='.$sr['ID'].' >'.$sr['Title'].'</option>';
 
echo '<script> var JsServiceData="'.$ServiceOptions.'"; </script>';

$sql =  "SELECT ID,Title, List_type_id  FROM manylist where List_type_id =6; ";
$ManyListData=$pdo->query($sql)->fetchAll();
$PeriodData='';
foreach ($ManyListData as $md)
{
	$PeriodData.='<option value='.$md['ID'].' >'.$md['Title'].'</option>'; 
	
}
echo '<script> var jsPeriodData="'.$PeriodData.'";</script>'; 
?>
<link rel='stylesheet' href='GrdExp/css/bootstrap-table.min.css'>
<link rel='stylesheet' href='GrdExp/css/bootstrap-editable.css'>
<div class="ServiceActivity-fluid fill">
   
    <div class="row">
	<div  class="col-md-2"></div>
        <div class="col-md-2 compose-ml">
            <button type="button" id="btnAddNewServiceActivity" class="btn btn-primary pull-right">اضافة نشاط خدمي</button>
        </div>
       
    </div>
    <br />
	<div  class="col-md-2"></div>
	<div class="col-md-8" >
	<table class="table table-bordered table-hover table-striped" data-toggle="table"  data-search="true"
			 data-filter-control="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar"
			  data-show-pagination-switch="true" data-pagination="true" data-id-field="ID" data-page-size="50"  data-side-pagination="client"
            class="table-responsive" id="ServiceActivityGrid">
	   
										<thead>
									
                                                <tr>
												    <th  data-field="ID" data-width="3%" data-filter-control="input" data-sortable="true">الرقم</th>
													<th  data-field="STitle" data-filter-control="select" data-sortable="true">الخدمة</th>
													<th  data-field="Title" data-filter-control="select" data-sortable="true">النشاط</th>
													<th  data-field="Needed_period_No" data-filter-control="input" data-sortable="true">الكمية/المدة</th>
													<th  data-field="Needed_period_title" data-filter-control="input" data-sortable="true">الوحدة</th>
													<th  data-field="Created_date" data-filter-control="input" data-sortable="true">تاريخ الاضافة</th>
													<th  data-field="Created_user" data-filter-control="input" data-sortable="true">مستخدم الاضافة</th>
													<th  data-field="Modified_date" data-filter-control="input" data-sortable="true">تاريخ التعديل</th>
													<th  data-field="Modified_user" data-filter-control="input" data-sortable="true">مستخدم التعديل</th>
													<th data-formatter="EditServiceActivityFormatter" >تعديل</th>
													

												</tr>
                                            </thead>
                                             <tbody id="TblRequestsBody">
											
											 </tbody>
                                        </table>
  
</div>

<!-- Modal -->
<div class="modal fade" id="ServiceActivityFormModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">بيانات النشاط</h4>
            </div>
            <div class="modal-body">
                <form data-toggle="validator" role="form" id="frm_ServiceActivity">
                    <input type="hidden" id="ServiceActivityID" name="ServiceActivityID" value="0" />
                    <div class="form-group"> <label for="Customer_id">الخدمة: <span class="rqd">*</span> :</label><select class="form-control" id="slcServicesId" name="slcServicesId"  required>
												<select></div>
					<div class="form-group"> <label for="ContractId">الاسم :<span class="rqd">*</span> :</label><input type="text" class="form-control" id="ServiceActivityTitle" name="ServiceActivityTitle"  required></div>
					<div class="form-group"> <label for="Customer_id">الكمية/المدة :<span class="rqd">*</span> :</label><input type="number"  class="form-control" id="ServiceActivityNeeded_period_No" name="ServiceActivityNeeded_period_No" required></div>
					<div class="form-group"> <label for="Customer_id">الوحدة: <span class="rqd">*</span> :</label><select class="form-control" id="ServiceActivityNeeded_period_id" name="ServiceActivityNeeded_period_id"  required>
												<option value="1">يوم</option>
                                                <option value="2">اسبوع</option>
												<option value="1">شهر</option><select></div>
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
	$('#ServiceActivityNeeded_period_id').html(jsPeriodData);
	var returnJsonServiceActivityArray=[];
	$('#slcServicesId').html(JsServiceData);
	//var CurrentRowIndex=0;
    // jQuery.fn.bootstrapTable.defaults.escape=false;
     
	$.get("AjaxFiles/AjaxRetrieveServiceActivity.php",function(r){
		 refereshTable(r);
	});
    
	     
	
	//,CustomerId,
	/*Events */
	   $('#btnAddNewServiceActivity').on('click',function(e){
		$('#ServiceActivityID').val(0);
		$('#frm_ServiceActivity').trigger("reset");
		$('#ServiceActivityFormModal').modal('show');
		
	});
	$('#btnSave').on('click',function(e){
		
		data = $('#frm_ServiceActivity').serializeArray();
		console.log(data);
		//data.push({"name":"ContractId","value":ContractId});
		$.post("AjaxFiles/AjaxEditServiceActivity.php",data,function(r){ $('#ServiceActivityFormModal').modal('hide');
		  		   refereshTable(r);
		});
		
		
	});
	
	
	
	
});
function refereshTable(JsonArray)
{  

 var t=$("#ServiceActivityGrid").bootstrapTable('destroy');
 t.bootstrapTable({ data:JSON.parse(JsonArray)});
	returnJsonServiceActivityArray=JSON.parse(JsonArray);
	$('.btnEditServiceActivity').each(function(k,i){
		$(this).on('click',function(e){
		currentRow = returnJsonServiceActivityArray[k];
		$('#ServiceActivityID').val(currentRow.ID),
       $('#ServiceActivityservice_id').val(currentRow.Service_id),
       $('#ServiceActivityTitle').val(currentRow.Title),
        $('#ServiceActivityNeeded_period_No').val(currentRow.Needed_period_No),
       $('#ServiceActivityNeeded_period_id').val(currentRow.Needed_period_id),
	    $('#ServiceActivityFormModal').modal('show');
		
		
												
		
	});
	
	
});
	
}

function EditServiceActivityFormatter(value, row, index) {
	 return [
        '<a class="like btnEditServiceActivity"  title="Like">',
        '<i class="fa fa-edit"></i> <span class="label label-primary">تعديل</span>',
        '</a>'
		
        
    ].join('');
	
   
}



</script>