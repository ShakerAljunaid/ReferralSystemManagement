<?php 
require_once('header-links.php');
$sql =  "SELECT ID,Title, List_type_id  FROM manylist where List_type_id in(12,20) order by Title; ";
$ManyListData=$pdo->query($sql)->fetchAll();
$UserTypeData='';
$PositionData='';
foreach ($ManyListData as $md)
{
	if($md['List_type_id']==12)
		$UserTypeData.='<option value='.$md['ID'].' >'.$md['Title'].'</option>'; 
	else
		$PositionData.='<option value='.$md['ID'].' >'.$md['Title'].'</option>'; 
	
}
echo '<script> var jsUserTypeData="'.$UserTypeData.'";var jsPositionData="'.$PositionData.'";</script>'; 

?>
<link rel='stylesheet' href='GrdExp/css/bootstrap-table.min.css'>
<link rel='stylesheet' href='GrdExp/css/bootstrap-editable.css'>
<div class="Users-fluid fill">
   
    <div class="row">
	<div  class="col-md-2"></div>
        <div class="col-md-2 compose-ml">
            <button type="button" id="btnAddNewUsers" class="btn btn-primary pull-right">اضافة مستخدم</button>
        </div>
       
    </div>
    <br />
	<div  class="col-md-2"></div>
	<div class="col-md-8" >
	<table class="table table-bordered table-hover table-striped" data-toggle="table"  data-search="true"
			 data-filter-control="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar"
			  data-show-pagination-switch="true" data-pagination="true" data-id-field="ID" data-page-size="50"  data-side-pagination="client"
            class="table-responsive" id="UsersGrid">
	   
										<thead>
									
                                                <tr>
												    <th  data-field="ID" data-width="3%" data-filter-control="input" data-sortable="true">الرقم</th>
													<th  data-field="First_name" data-filter-control="select" data-sortable="true">الاسم الاول</th>
													<th  data-field="Last_name" data-filter-control="select" data-sortable="true">الاسم الاخير</th>
													<th  data-field="Gender_name" data-filter-control="select" data-sortable="true">النوع</th>
													<th  data-field="Phone_no" data-filter-control="input" data-sortable="true">رقم الهاتف</th>
													<th  data-field="Email" data-filter-control="input" data-sortable="true">اسم المستخدم</th>
													<th  data-field="User_type_title" data-filter-control="select" data-sortable="true">نوع المستخدم</th>
													<th  data-field="Position_title" data-filter-control="select" data-sortable="true">الوظيفة</th>
													<th  data-field="Active_name" data-filter-control="select" data-sortable="true">مفعل</th>
													<th data-formatter="EditUsersFormatter" >تعديل</th>
												</tr>
                                            </thead>
                                             <tbody id="TblRequestsBody">
											
											 </tbody>
                                        </table>
  
</div>

<!-- Modal -->
<div class="modal fade" id="UsersFormModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">معلومات المستخدم</h4>
            </div>
            <div class="modal-body">
                <form data-toggle="validator" role="form" id="frm_Users">
                    <input type="hidden" id="UsersID" name="User_ID" value="0" />
					<input type="hidden" id="PID" name="PID" value="0" />
					<div class="form-group"> <label for="ContractId">الاسم الاول :<span class="rqd">*</span> :</label><input type="text" class="form-control" id="First_name" name="First_name"  required></div>
					<div class="form-group"> <label for="ContractId">الاسم الاخير :<span class="rqd">*</span> :</label><input type="text"  class="form-control" id="Last_name" name="Last_name" required></div>
                    
					<div class="form-group">
                                            <label>النوع:</label>
                                            <label class="radio-inline">
                                                <input type="radio" name="Gender" id="Gender1" value="1" checked >
												ذكر
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="Gender" id="Gender2" value="2">انثى
                                            </label>
                                     </div>
					<div class="form-group"> <label for="Customer_id">رقم الهاتف :<span class="rqd">*</span> :</label><input type="number"  class="form-control" id="Phone_no" name="Phone_no" required></div>
					<div class="form-group"> <label for="Customer_id">اسم المستخدم :<span class="rqd">*</span> :</label><input type="text"  class="form-control" id="Email" name="Email" required></div>
					<div class="form-group"> <label for="Customer_id">كلمة المرور :<span class="rqd">*</span> :</label><input type="password"  class="form-control" id="Password" name="Password" required></div>
					<div class="form-group"> <label for="Customer_id">نوع المستخدم : <span class="rqd">*</span> :</label><select class="form-control" id="User_type_id" name="User_type_id"  required>
                                                <option value="1">استقبال</option>
                                                <option value="2">اخصائي</option>
                                                <option value="3">مدير النظام</option></select></div>
					<div class="form-group"> <label for="Customer_id">الوظيفة : <span class="rqd">*</span> :</label><select class="form-control" id="Position_id" name="Position_id"  required>
                                                <option value="1">استقبال</option>
                                                <option value="2">اخصائي</option>
                                                <option value="3">طبيب نفسي</option>
                                                <option value="5">مدير</option></select></div>
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
	$('#User_type_id').html(jsUserTypeData);
	$('#Position_id').html(jsPositionData);
	
	var returnJsonUsersArray=[];
	//var CurrentRowIndex=0;
    // jQuery.fn.bootstrapTable.defaults.escape=false;
     
	$.get("AjaxFiles/AjaxRetrieveUsers.php",function(r){
		console.log(r);
		 refereshTable(r);
	});
    
	     
	
	//,CustomerId,
	/*Events */
	   $('#btnAddNewUsers').on('click',function(e){
		$('#User_ID').val(0);
		$('#PID').val(0);
		$('#frm_Users').trigger("reset");;
		$('#UsersFormModal').modal('show');
		
	});
	$('#btnSave').on('click',function(e){
		
		data = $('#frm_Users').serializeArray();
		console.log(data);
		//data.push({"name":"ContractId","value":ContractId});
		$.post("AjaxFiles/AjaxEditUser.php",data,function(r){ $('#UsersFormModal').modal('hide');
		  		   refereshTable(r);
		});
		
		
	});
	
	
	
	
});
function refereshTable(JsonArray)
{  

 var t=$("#UsersGrid").bootstrapTable('destroy');
 t.bootstrapTable({ data:JSON.parse(JsonArray)});
	returnJsonUsersArray=JSON.parse(JsonArray);
	$('.btnEditUsers').each(function(k,i){
		$(this).on('click',function(e){
		currentRow = returnJsonUsersArray[k];
		$('#User_ID').val(currentRow.ID),
		$('#PID').val(currentRow.PID),
       $('#First_name').val(currentRow.First_name),
       $('#Last_name').val(currentRow.Last_name),
        $('#Gender').val(currentRow.Gender).change(),
       $('#Phone_no').val(currentRow.Phone_no),
	    $('#Email').val(currentRow.Email),
		$('#Password').val(currentRow.Password),
        $('#User_type_id').val(currentRow.User_type_id).change(),
       $('#Position_id').val(currentRow.Position_id).change(),
	    $('#UsersFormModal').modal('show');									
		
	});
	
	
});
	
}

function EditUsersFormatter(value, row, index) {
	 return [
        '<a class="like btnEditUsers"  title="Like">',
        '<i class="fa fa-edit"></i> <span class="label label-primary">تعديل</span>',
        '</a>'
		
        
    ].join('');
	
   
}



</script>