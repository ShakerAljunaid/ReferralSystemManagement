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
<div class="Behavior-fluid fill">
   <br />
    <div class="row">
	<div  class="col-md-2"></div>
	
        <div class="col-md-2 compose-ml">
		
            <button type="button" id="btnAddNewBehavior" class="btn btn-primary pull-right">إضافة تشخيص مبدئي جديد</button>
        </div>
       
    </div>
    <br />
	<div  class="col-md-2"></div>
	<div class="col-md-8" >
	<table class="table table-bordered table-hover table-striped" data-toggle="table"  data-search="true"
			 data-filter-control="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar"
			  data-show-pagination-switch="true" data-pagination="true" data-id-field="ID" data-page-size="50"  data-side-pagination="client"
            class="table-responsive" id="BehaviorGrid">
	   
										<thead>
									
                                                <tr>
												    <th  data-field="ID" data-width="3%" data-filter-control="input" data-sortable="true">الرقم</th>
													<th  data-field="Parent_title" data-filter-control="select" data-sortable="true">نوع التشخيص</th>
													<th  data-field="Title" data-filter-control="input" data-sortable="true">الوصف</th>
													<th data-formatter="EditBehaviorFormatter" >تعديل</th>
													

												</tr>
                                            </thead>
                                             <tbody id="TblRequestsBody">
											
											 </tbody>
                                        </table>
  
</div>

<!-- Modal -->
<div class="modal fade" id="BehaviorFormModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">التشخيص</h4>
            </div>
            <div class="modal-body">
                <form data-toggle="validator" role="form" id="frm_Behavior">
                    <input type="hidden" id="s_ID" name="s_ID" value="0" />
					<div class="form-group"> <label for="Customer_id">نوع التشخيص :<span class="rqd">*</span> :</label><select class="form-control" id="s_Behavior_cat" name="s_Behavior_cat"  required>
												<option value="380">عينية</option>
                                                <option value="381">مزمنة</option></select></div>
					<div class="form-group"> <label for="ContractId">الوصف :<span class="rqd">*</span> :</label><input type="text" class="form-control" id="s_Title" name="s_Title"  required></div>
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
	$('#s_Behavior_cat').html(jsRateData);
	var returnJsonBehaviorArray=[];
	//var CurrentRowIndex=0;
    // jQuery.fn.bootstrapTable.defaults.escape=false;
     
	$.get("AjaxFiles/AjaxRetrieveBehaviors.php",function(r){
		console.log(r);
		 refereshTable(r);
	});
    
	     
	
	//,CustomerId,
	/*Events */
	   $('#btnAddNewBehavior').on('click',function(e){
		$('#s_ID').val(0);
		$('#frm_Behavior').trigger("reset");;
		$('#BehaviorFormModal').modal('show');
		
	});
	$('#btnSave').on('click',function(e){
		
		data = $('#frm_Behavior').serializeArray();
		//console.log(data);
		//data.push({"name":"ContractId","value":ContractId});
		$.post("AjaxFiles/AjaxEditBehavior.php",data,function(r){ $('#BehaviorFormModal').modal('hide');
		
		  		 refereshTable(r);
		});
		
		
	});
	
	
	
	
});
function refereshTable(JsonArray)
{  

 var t=$("#BehaviorGrid").bootstrapTable('destroy');
 t.bootstrapTable({ data:JSON.parse(JsonArray)});
	returnJsonBehaviorArray=JSON.parse(JsonArray);
	$('.btnEditBehavior').each(function(k,i){
		$(this).on('click',function(e){
		currentRow = returnJsonBehaviorArray[k];
		$('#s_ID').val(currentRow.ID),
       $('#s_Behavior_cat').val(currentRow.Parent_id),
       $('#s_Title').val(currentRow.Title),
	    $('#BehaviorFormModal').modal('show');
		
		
												
		
	});
	
	
});
	
}

function EditBehaviorFormatter(value, row, index) {
	 return [
        '<a class="like btnEditBehavior"  title="Like">',
        '<i class="fa fa-edit"></i> <span class="label label-primary">تعديل</span>',
        '</a>'
		
        
    ].join('');
	
   
}



</script>