<?php 
require_once('header-links.php');

$sql =  "SELECT ID,Title, List_type_id  FROM manylist where List_type_id =4; ";
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
<div class="Service-fluid fill">
   <br />
    <div class="row">
	<div  class="col-md-2"></div>
	
        <div class="col-md-2 compose-ml">
		
            <button type="button" id="btnAddNewService" class="btn btn-primary pull-right">إضافة خدمة جديدة</button>
        </div>
       
    </div>
    <br />
	<div  class="col-md-2"></div>
	<div class="col-md-8" >
	<table class="table table-bordered table-hover table-striped" data-toggle="table"  data-search="true"
			 data-filter-control="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar"
			  data-show-pagination-switch="true" data-pagination="true" data-id-field="ID" data-page-size="50"  data-side-pagination="client"
            class="table-responsive" id="ServiceGrid">
	   
										<thead>
									
                                                <tr>
												    <th  data-field="ID" data-width="3%" data-filter-control="input" data-sortable="true">الرقم</th>
													<th  data-field="Service_cat_title" data-filter-control="select" data-sortable="true">نوع الخدمة</th>
													<th  data-field="Title" data-filter-control="input" data-sortable="true">الاسم</th>
													<th  data-field="Decription" data-filter-control="input" data-sortable="true">الوصف</th>
													<th  data-field="Created_date" data-filter-control="input" data-sortable="true">تاريخ الاضافة</th>
													<th  data-field="Created_user" data-filter-control="input" data-sortable="true">مستخدم الاضافة</th>
													<th  data-field="Modified_date" data-filter-control="input" data-sortable="true">تاريخ التعديل</th>
													<th  data-field="Modified_user" data-filter-control="input" data-sortable="true">مستخدم التعديل</th>
													<th data-formatter="EditServiceFormatter" >تعديل</th>
													

												</tr>
                                            </thead>
                                             <tbody id="TblRequestsBody">
											
											 </tbody>
                                        </table>
  
</div>

<!-- Modal -->
<div class="modal fade" id="ServiceFormModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">الخدمة</h4>
            </div>
            <div class="modal-body">
                <form data-toggle="validator" role="form" id="frm_Service">
                    <input type="hidden" id="s_ID" name="s_ID" value="0" />
					<div class="form-group"> <label for="Customer_id">نوع الخدمة :<span class="rqd">*</span> :</label><select class="form-control" id="s_Service_cat" name="s_Service_cat"  required>
												<option value="380">عينية</option>
                                                <option value="381">مزمنة</option></select></div>
					<div class="form-group"> <label for="ContractId">الاسم :<span class="rqd">*</span> :</label><input type="text" class="form-control" id="s_Title" name="s_Title"  required></div>
					<div class="form-group"> <label for="ContractId">الوصف :<span class="rqd">*</span> :</label><input type="text"  class="form-control" id="s_Decription" name="s_Decription" required></div>
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
	$('#s_Service_cat').html(jsRateData);
	var returnJsonServiceArray=[];
	//var CurrentRowIndex=0;
    // jQuery.fn.bootstrapTable.defaults.escape=false;
     
	$.get("AjaxFiles/AjaxRetrieveServices.php",function(r){
		console.log(r);
		 refereshTable(r);
	});
    
	     
	
	//,CustomerId,
	/*Events */
	   $('#btnAddNewService').on('click',function(e){
		$('#s_ID').val(0);
		$('#frm_Service').trigger("reset");;
		$('#ServiceFormModal').modal('show');
		
	});
	$('#btnSave').on('click',function(e){
		
		data = $('#frm_Service').serializeArray();
		//console.log(data);
		//data.push({"name":"ContractId","value":ContractId});
		$.post("AjaxFiles/AjaxEditService.php",data,function(r){ $('#ServiceFormModal').modal('hide');
		
		  		 refereshTable(r);
		});
		
		
	});
	
	
	
	
});
function refereshTable(JsonArray)
{  

 var t=$("#ServiceGrid").bootstrapTable('destroy');
 t.bootstrapTable({ data:JSON.parse(JsonArray)});
	returnJsonServiceArray=JSON.parse(JsonArray);
	$('.btnEditService').each(function(k,i){
		$(this).on('click',function(e){
		currentRow = returnJsonServiceArray[k];
		$('#s_ID').val(currentRow.ID),
       $('#s_Service_cat').val(currentRow.Service_cat),
       $('#s_Title').val(currentRow.Title),
        $('#s_Decription').val(currentRow.Decription),
	    $('#ServiceFormModal').modal('show');
		
		
												
		
	});
	
	
});
	
}

function EditServiceFormatter(value, row, index) {
	 return [
        '<a class="like btnEditService"  title="Like">',
        '<i class="fa fa-edit"></i> <span class="label label-primary">تعديل</span>',
        '</a>'
		
        
    ].join('');
	
   
}



</script>