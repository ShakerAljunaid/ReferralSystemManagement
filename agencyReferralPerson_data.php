<?php 
require_once('header-links.php');

$sql = 'SELECT  ID,Name from  externalagency'; 
$ServiceData = $pdo->query($sql)->fetchAll();
$AgencyOptions='';
foreach ($ServiceData as $sr)
 $AgencyOptions.='<option value='.$sr['ID'].' >'.$sr['Name'].'</option>';
 
echo '<script> var JsAgencyData="'.$AgencyOptions.'"; </script>';
?>
<link rel='stylesheet' href='GrdExp/css/bootstrap-table.min.css'>
<link rel='stylesheet' href='GrdExp/css/bootstrap-editable.css'>
<div class="ReferralPerson-fluid fill">
   
    <div class="row">
	<div  class="col-md-2"></div>
        <div class="col-md-2 compose-ml">
            <button type="button" id="btnAddNewReferralPerson" class="btn waves-effect pull-left">إضافة مختص احالة لجهة خارجية</button>
        </div>
       
    </div>
    <br />
	<div  class="col-md-2"></div>
	<div class="col-md-8" >
	<table class="table table-bordered table-hover table-striped" data-toggle="table"  data-search="true"
			 data-filter-control="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar"
			  data-show-pagination-switch="true" data-pagination="true" data-id-field="ID" data-page-size="50"  data-side-pagination="client"
            class="table-responsive" id="ReferralPersonGrid">
	   
										<thead>
									
                                                <tr>
												    <th  data-field="ID" data-width="3%" data-filter-control="input" data-sortable="true">الرقم</th>
													<th  data-field="First_name" data-filter-control="select" data-sortable="true">الاسم الاول</th>
													<th  data-field="Last_name" data-filter-control="select" data-sortable="true">الاسم الاخير</th>
													<th  data-field="Gender_name" data-filter-control="select" data-sortable="true">النوع</th>
													<th  data-field="Phone_no" data-filter-control="input" data-sortable="true">رقم الهاتف</th>
													<th  data-field="Agency_name" data-filter-control="input" data-sortable="true">الجهة الخارجية</th>
													<th  data-field="Created_date" data-filter-control="input" data-sortable="true">تاريخ الاضافة</th>
													<th  data-field="Created_user" data-filter-control="input" data-sortable="true">مستخدم الاضافة</th>
													<th data-formatter="EditReferralPersonFormatter" >تعديل</th>
													

												</tr>
                                            </thead>
                                             <tbody id="TblRequestsBody">
											
											 </tbody>
                                        </table>
  
</div>

<!-- Modal -->
<div class="modal fade" id="ReferralPersonFormModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">الشخص المسؤول: الجهة</h4>
            </div>
            <div class="modal-body">
                <form data-toggle="validator" role="form" id="frm_ReferralPerson">
                    <input type="hidden" id="ReferralPersonID" name="ReferralPersonID" value="0" />
					<input type="hidden" id="PersonID" name="PersonID" value="0" />
					<div class="form-group"> <label for="ContractId">الاسم الاول :<span class="rqd">*</span> :</label><input type="text" class="form-control" id="ReferralPersonFirst_name" name="ReferralPersonFirst_name"  required></div>
					<div class="form-group"> <label for="ContractId">الاسم الاخير :<span class="rqd">*</span> :</label><input type="text"  class="form-control" id="ReferralPersonLast_name" name="ReferralPersonLast_name" required></div>
                    
					<div class="form-group">
                                            <label>النوع:</label>
                                            <label class="radio-inline">
                                                <input type="radio" name="ReferralPersonGender" id="optionsRadiosInline1" value="1" checked >
												ذكر
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="ReferralPersonGender" id="optionsRadiosInline2" value="2">انثى
                                            </label>
                                     </div>
					<div class="form-group"> <label for="Customer_id">رقم الهاتف<span class="rqd">*</span> :</label><input type="text"  class="form-control" id="ReferralPersonPhone_no" name="ReferralPersonPhone_no" required></div>
					<div class="form-group"> <label for="Customer_id">الجهة الخارجية: <span class="rqd">*</span> :</label><select class="form-control" id="ReferralPersonAgency_id" name="ReferralPersonAgency_id"  required><option value="1">الأمانة</option>
                                                <option value="2">مستشفى الامانة</option>
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
	$('#ReferralPersonAgency_id').html(JsAgencyData);
	var returnJsonReferralPersonArray=[];
	//var CurrentRowIndex=0;
    // jQuery.fn.bootstrapTable.defaults.escape=false;
     
	$.get("AjaxFiles/AjaxRetrieveAgencyReferralPerson.php",function(r){
		console.log(r);
		 refereshTable(r);
	});
    
	     
	
	//,CustomerId,
	/*Events */
	   $('#btnAddNewReferralPerson').on('click',function(e){
		$('#ReferralPersonID').val(0);
		$('#PersonID').val(0);
		$('#frm_ReferralPerson').trigger("reset");;
		$('#ReferralPersonFormModal').modal('show');
		
	});
	$('#btnSave').on('click',function(e){
		
		data = $('#frm_ReferralPerson').serializeArray();
		console.log(data);
		//data.push({"name":"ContractId","value":ContractId});
		$.post("AjaxFiles/AjaxEditAgencyReferralPerson.php",data,function(r){ $('#ReferralPersonFormModal').modal('hide');
		  		   refereshTable(r);
		});
		
		
	});
	
	
	
	
});
function refereshTable(JsonArray)
{  

 var t=$("#ReferralPersonGrid").bootstrapTable('destroy');
 t.bootstrapTable({ data:JSON.parse(JsonArray)});
	returnJsonReferralPersonArray=JSON.parse(JsonArray);
	$('.btnEditReferralPerson').each(function(k,i){
		$(this).on('click',function(e){
		currentRow = returnJsonReferralPersonArray[k];
		$('#ReferralPersonID').val(currentRow.ID),
		$('#PersonID').val(currentRow.PID),
       $('#ReferralPersonFirst_name').val(currentRow.First_name),
       $('#ReferralPersonLast_name').val(currentRow.Last_name),
        $('#ReferralPersonGender').val(currentRow.Gender),
       $('#ReferralPersonPhone_no').val(currentRow.Phone_no),
	    $('#ReferralPersonAgency_id').val(currentRow.Agency_id),
	    $('#ReferralPersonFormModal').modal('show');
		
		
												
		
	});
	
	
});
	
}

function EditReferralPersonFormatter(value, row, index) {
	 return [
        '<a class="like btnEditReferralPerson"  title="Like">',
        '<i class="fa fa-edit"></i> <span class="label label-primary">تعديل</span>',
        '</a>'
		
        
    ].join('');
	
   
}



</script>