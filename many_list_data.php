<?php 
require_once('header-links.php');

$sql =  "SELECT ID,Title, List_type_id  FROM manylist where List_type_id=".$_GET["TypeId"];
$ManyListData=$pdo->query($sql)->fetchAll();

echo '<script> var jsManyListType='.json_encode($ManyListData).';</script>'; 
?>
<link rel='stylesheet' href='GrdExp/css/bootstrap-table.min.css'>
<link rel='stylesheet' href='GrdExp/css/bootstrap-editable.css'>
<div class="Behavior-fluid fill">
   <br />
    <div class="row">
	<div  class="col-md-2"></div>
	
        <div class="col-md-2 compose-ml">
		
            <button type="button" id="btnAddNewData" class="btn btn-primary pull-right">إضافة عنصر</button>
        </div>
       
    </div>
    <br />
	<div  class="col-md-2"></div>
	<div class="col-md-8" >
	<table class="table table-bordered table-hover table-striped" data-toggle="table"  data-search="true"
			 data-filter-control="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar"
			  data-show-pagination-switch="true" data-pagination="true" data-id-field="ID" data-page-size="50"  data-side-pagination="client"
            class="table-responsive" id="ManyListGrid">
	   
										<thead>
									
                                                <tr>
												    <th  data-field="ID" data-width="3%" data-filter-control="input" data-sortable="true">الرقم</th>
													<th  data-field="Title" data-filter-control="input" data-sortable="true">الوصف</th>
													<th data-formatter="EditBehaviorFormatter" >تعديل</th>
													

												</tr>
                                            </thead>
                                             <tbody id="TblRequestsBody">
											
											 </tbody>
                                        </table>
  
</div>

<!-- Modal -->
<div class="modal fade" id="ManyListFormModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">العنصر</h4>
            </div>
            <div class="modal-body">
                <form data-toggle="validator" role="form" id="frm_manyList">
                    <input type="hidden" id="s_ID" name="s_ID" value="0" />
					 <input type="hidden" id="s_TypeId" name="s_TypeId" value="0" />
				
					<div class="form-group"> <label>الاسم :<span class="rqd">*</span> :</label><input type="text" class="form-control" id="s_Title" name="s_Title"  required></div>
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
	$('#s_TypeId').val(<?php echo $_GET["TypeId"]; ?>);
	var returnJsonManyListArray=[];
	//var CurrentRowIndex=0;
    // jQuery.fn.bootstrapTable.defaults.escape=false;
      refereshTable(jsManyListType);
	
    
	     
	
	//,CustomerId,
	/*Events */
	   $('#btnAddNewData').on('click',function(e){
		$('#s_ID').val(0);
		$('#frm_manyList').trigger("reset");;
		$('#ManyListFormModal').modal('show');
		
	});
	$('#btnSave').on('click',function(e){
		
		data = $('#frm_manyList').serializeArray();
		$.ajax({url:"AjaxFiles/AjaxAddEditManyListItem.php",async:false,
		data,success:function(r){ $('#ManyListFormModal').modal('hide');
		 	 refereshTable(JSON.parse(r));
		}
		});
		
		
	});
	
	
	
	
});
function refereshTable(JsonArray)
{  

 var t=$("#ManyListGrid").bootstrapTable('destroy');
 t.bootstrapTable({ data:JsonArray});
	returnJsonManyListArray=JsonArray;
	
	
}
function EditCurrentRow(index)
{
	currentRow = returnJsonManyListArray[index];
		$('#s_ID').val(currentRow.ID),
         $('#s_Title').val(currentRow.Title),
	    $('#ManyListFormModal').modal('show');
	
}


function EditBehaviorFormatter(value, row, index) {
	 return [
        '<a class="like "  title="Like" href="javascript:void(0);" onclick="EditCurrentRow('+index+')">',
        '<i class="fa fa-edit"></i> <span class="label label-primary">تعديل</span>',
        '</a>'
		
        
    ].join('');
	
   
}



</script>