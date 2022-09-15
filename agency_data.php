<?php 
require_once('header-links.php');

$sql =  "SELECT ID,Title, List_type_id  FROM manylist where List_type_id =1; ";
$ManyListData=$pdo->query($sql)->fetchAll();
$GovernateData='';
foreach ($ManyListData as $md)
{
	$GovernateData.='<option value='.$md['ID'].' >'.$md['Title'].'</option>'; 
	
}
echo '<script> var jsGovernateData="'.$GovernateData.'";</script>'; 
?>
<link rel='stylesheet' href='GrdExp/css/bootstrap-table.min.css'>
<link rel='stylesheet' href='GrdExp/css/bootstrap-editable.css'>
<div class="Agency-fluid fill">
   
    <div class="row">
	<div  class="col-md-2"></div>
        <div class="col-md-2 compose-ml">
            <button type="button" id="btnAddNewAgency" class="btn waves-effect pull-left">اضافة جهة احالة خارجية</button>
        </div>
       
    </div>
    <br />
	<div  class="col-md-2"></div>
	<div class="col-md-8" >
	<table class="table table-bordered table-hover table-striped" data-toggle="table"  data-search="true"
			 data-filter-control="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar"
			  data-show-pagination-switch="true" data-pagination="true" data-id-field="ID" data-page-size="50"  data-side-pagination="client"
            class="table-responsive" id="AgencyGrid">
	   
										<thead>
									
                                                <tr>
												    <th  data-field="ID" data-width="3%" data-filter-control="input" data-sortable="true">الرقم</th>
													<th  data-field="Name" data-filter-control="select" data-sortable="true">اسم الجهة</th>
													<th  data-field="Agency_governate_id" data-filter-control="select" data-sortable="true">المحافظة</th>
													<th  data-field="Agency_address" data-filter-control="input" data-sortable="true">العنوان</th>
													<th  data-field="Agency_phone" data-filter-control="input" data-sortable="true">رقم الهاتف</th>
													<th  data-field="Contact_person_name" data-filter-control="input" data-sortable="true">الشخص المسؤول</th>
													<th data-formatter="EditAgencyFormatter" >تعديل</th>
													

												</tr>
                                            </thead>
                                             <tbody id="TblRequestsBody">
											
											 </tbody>
                                        </table>
  
</div>

<!-- Modal -->
<div class="modal fade" id="AgencyFormModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">بيانات الجهة</h4>
            </div>
            <div class="modal-body">
                <form data-toggle="validator" role="form" id="frm_Agency">
                    <input type="hidden" id="AgencyId" name="AgencyId" value="0" />
					<div class="form-group"> <label for="ContractId">الاسم :<span class="rqd">*</span> :</label><input type="text" class="form-control" id="AgencyName" name="AgencyName"  required></div>
					<div class="form-group"> <label for="Customer_id">رقم الهاتف<span class="rqd">*</span> :</label><input type="text"  class="form-control" id="AgencyPhoneNo" name="AgencyPhoneNo" required></div>
                    <div class="form-group"> <label for="Customer_id">المحافظة: <span class="rqd">*</span> :</label><select class="form-control" id="GovernateId" name="GovernateId"  required><option value="1">الأمانة</option>
                                                <option value="2">صنعاء</option>
                                                <option value="3">عدن</option>
                                                <option value="4">تعز</option>
                                                <option value="5">الحديدة</option>
												 <option value="6">إب</option>
												 <option value="7">حضرموت</option>
												  <option value="8">لحج</option>
												 <option value="9">الضالع</option>
												  <option value="10">البيضاء</option>
												 <option value="11">مارب</option>
												  <option value="12">الجوف</option>
												   <option value="13">شبوة</option>
												  <option value="14">عمران</option>
												  <option value="15">صعدة</option>
												  <option value="16">حجة</option>
												  <option value="17">ريمة</option>
												  <option value="18">المهرة</option></select></div>
					 <div class="form-group"> <label for="Ordered_material_id">العنوان : <span class="rqd">*</span> :</label><input type="text" class="form-control" id="AgencyAddress" name="AgencyAddress" required></div>
                    <div class="form-group"> <label for="Ordered_material_id">الشخص المسؤول: <span class="rqd">*</span> :</label><input type="text" class="form-control" id="ContactPersonName" name="ContactPersonName" required></div>
                     <div class="form-group"> <label for="Description">ملاحظات :</label><textarea class="form-control coment" id="Description" name="Description" rows="3" placeholder="Add contarct description..."></textarea></div>
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
	$('#GovernateId').html(jsGovernateData);
	var returnJsonAgencyArray=[];
	//var CurrentRowIndex=0;
    // jQuery.fn.bootstrapTable.defaults.escape=false;
     
	$.get("AjaxFiles/AjaxRetrieveAgency.php",function(r){
		 refereshTable(r);
	});
    
	     
	
	//,CustomerId,
	/*Events */
	   $('#btnAddNewAgency').on('click',function(e){
		$('#AgencyId').val(0);
		$('#frm_Agency').trigger("reset");;
		$('#AgencyFormModal').modal('show');
		
	});
	$('#btnSave').on('click',function(e){
		
		data = $('#frm_Agency').serializeArray();
		console.log(data);
		//data.push({"name":"ContractId","value":ContractId});
		$.post("AjaxFiles/AjaxNewExternaAgency.php",data,function(r){ $('#AgencyFormModal').modal('hide');
		  		   refereshTable(r);
		});
		
		
	});
	
	
	
	
});
function refereshTable(JsonArray)
{  

 var t=$("#AgencyGrid").bootstrapTable('destroy');
 t.bootstrapTable({ data:JSON.parse(JsonArray)});
	returnJsonAgencyArray=JSON.parse(JsonArray);
	$('.btnEditAgency').each(function(k,i){
		$(this).on('click',function(e){
		currentRow = returnJsonAgencyArray[k];
		$('#AgencyId').val(currentRow.ID),
       $('#AgencyName').val(currentRow.Name),
       $('#ContactPersonName').val(currentRow.Contact_person_name),
        $('#AgencyPhoneNo').val(currentRow.Agency_phone),
       $('#AgencyAddress').val(currentRow.Agency_address),
	    $('#GovernateId').val(currentRow.Agency_governate_id),
         $('#Description').val(currentRow.Description);
	    $('#AgencyFormModal').modal('show');
		
		
												
		
	});
	
	
});
	
}

function EditAgencyFormatter(value, row, index) {
	 return [
        '<a class="like btnEditAgency"  title="Like">',
        '<i class="fa fa-edit"></i> <span class="label label-primary">تعديل</span>',
        '</a>'
		
        
    ].join('');
	
   
}



</script>