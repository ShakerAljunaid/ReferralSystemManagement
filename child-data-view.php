<?php 
require_once('header-links.php');
		         
      $sql = 'SELECT  * from  childGridViewData'; 
$ChildData = $pdo->query($sql)->fetchAll();
echo '<script> var JsChildData='.json_encode($ChildData).'; </script>';
 
 ?>
 <div id="page-wrapper">
<div class="row">

<br>
    <div class="col-lg-12">
        <div class="panel panel-default">
           
            <div class="panel-body">
                <div class="row">
                    <!-- /.col-lg-6 (nested) -->
                    <div class="container-fluid">
                        <div class="row">
<div class="col-md-12 ">
                                <div class="panel panel-default panel-table">
                                    <div class="panel-body">
								<div id="toolbar">
												<form id="frmSearch" data-toggle="validator">
												   <div class="col-sm-4">
                             			   <div class="form-group">
                                            <label>من :</label>
                                            <input type="date" class="form-control no-repeat cfrm rltvChg" id="SearchFrm" name="SearchFrm" required>
                                          
                                        </div>
								  </div>
											
												   <div class="col-sm-4">
                             			   <div class="form-group">
                                            <label>إلى:</label>
                                            <input type="date" class="form-control no-repeat cfrm rltvChg" id="SearchTo" name="SearchTo" required>
                                          
                                        </div>
								  </div>
								  
												   <div class="col-sm-3">
                             			   <div class="form-group">
                                            <label>حسب فترة:</label>
                                            <select id="SearchPerid" class="form-control" ><option value=0 >....</option><option value=1 >اليوم</option><option value=2 >هذا الاسبوع</option><option value=3 >هذا الشهر</option></select>
                                          
                                        </div>
								  </div>
											  <div class="col-sm-1">
                             			   <div class="form-group">
                                            <label>بحث:</label>
											<button type="submit" id="btnSearch" name="btnSearch"   class="btn btn-primary"><span><i class="notika-icon notika-search"></i></span></button>
                                          
                                          
                                        </div>
								  </div>	
								  </form>
                            </div>
			      <table class="table table-bordered table-hover table-striped"
						data-toggle="table"
			 data-search="true"
			 data-filter-control="true" 
			 data-show-export="true"
			 data-click-to-select="true"
			 data-toolbar="#toolbar"
			  data-show-pagination-switch="true" data-pagination="true" data-id-field="ID" data-page-size="50"  data-side-pagination="client"
            class="table-responsive " id="tblPendingChildrenCases"  >
										<thead>
                                                <tr>
												 <th  data-field="childId" data-filter-control="input" data-sortable="true">الرقم</th>
													<th data-field="ChildFullName" data-filter-control="input" data-sortable="true" >اسم الطفل</th>
                                                    <th  data-field="Gender" data-filter-control="select" data-sortable="true">النوع</th>
													 <th  data-field="DisplacedState" data-filter-control="select" data-sortable="true">نازح؟</th>
													  <th  data-field="childSource" data-filter-control="select" data-sortable="true">المصدر</th>
													
													
													<th  data-field="CareGiverFullName" data-filter-control="input" data-sortable="true">اسم المُعتني</th>
														<th  data-field="Identity_no" data-filter-control="input" data-sortable="true">رقم البطاقة</th>
													
													<th  data-field="CareGiverPhoneNo" data-filter-control="input" data-sortable="true">رقم الهاتف</th>
													<th  data-field="ChildAddress" data-filter-control="input" data-sortable="true"> العنوان</th>
													<th  data-field="Created_date" data-filter-control="input" data-sortable="true"> تاريخ الستجيل</th>
                                                   	<th data-formatter="EditDataFormatter" >تعديل</th>
													<?php if($UserType==435 || $UserType==436){ ?>
												    <th data-formatter="PrintDataFormatter" >طباعة</th>
													
													<?php } ?>
													<?php if($UserType==435 ){ ?>
													  <th data-formatter="DeleteDataFormatter" >حذف</th><?php } ?>
													
 
  
												</tr>
                                            </thead>
                                             <tbody id="TblRequestsBody">
											
											 </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
   </div>
                    </div>
                </div>
                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
<!-- Modal -->
<div class="modal fade ConfirmQuestion" style="overflow-y: scroll;"   tabindex="-1"   role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true"  id="ConfirmQuestionModal">
  <div class="modal-dialog modal-lg">
   <div class="modal-content"  >
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title modalHeader" id="myModalLabel">حذف</h4>
      </div>
	  <div class="modal-body">
	  <div class="form-group">
	   <div class="form-group hidden"> <label>رقم الحساب:</label> <input type="text" class="form-control" id="ChildID"  readonly></div>
	  
	 
		</div>
	   <div class="form-group"><label>هل انت متأكد من حذف جميع بيانات <span  id="ChildName" readonly></span> ؟</label></div>
	   
	  
		  
	  </div>
      <div class="modal-footer">
	     <button type="button" class="btn btn-danger action-button " id="btnConfirmDelete"  >متأكد</button>
        <button type="button" class="btn btn-default action-button close"  data-dismiss="modal" aria-label="Close" >خروج</button>
      </div>
    </div>
  </div>
</div>





  </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
    </div>
	
	
    <!-- /#wrapper -->

  <?php require_once('footer-links.php'); ?>  
</body>
<script>
	$( "#cases-page" ).addClass( "active" );
	$( "#mailbox" ).addClass( "active" );
</script>

<script>


$(document).ready(function(){
$(function(){
	console.log(JsChildData);
	var CurrentRowIndex=0;
 jQuery.fn.bootstrapTable.defaults.escape=false;
      var t=$("#tblPendingChildrenCases").bootstrapTable('destroy');
		//jQuery.fn.bootstrapTable.defaults.escape=false;
		
		t.bootstrapTable({ data:JsChildData});
		
	 		 $('#btnConfirmDelete').on('click',function(e){
			 
			 $.post('AjaxFiles/AjaxDeleteChild.php',{childId:$('#ChildID').val()},function(r){console.log(r);
			   var t=$("#tblPendingChildrenCases").bootstrapTable('destroy');
				t.bootstrapTable({ data:JSON.parse(r)});
				$('#ConfirmQuestionModal').modal('hide');
					mkNoti('تم', 'تم الحفظ بنجاح! ', { status: 'success' });
			 
			 });
		 });
		 $('#SearchPerid').on('change',function(e){
		if($('#SearchPerid').val()==1)
		{	let today = new Date();
            let day = new Date(today.setDate(today.getDate()+1)).toISOString().slice(0, 10)
			
	      $('#SearchFrm').val(day ).attr('readonly',true);
			$('#SearchTo').val(day).attr('readonly',true);
		}
		else if($('#SearchPerid').val()==2)
		{let week=getWeek();
			$('#SearchFrm').val(week[0] ).attr('readonly',true);
			$('#SearchTo').val(week.pop() ).attr('readonly',true);
			 
		}
		else if($('#SearchPerid').val()==3)
		{ let month=GFG_Fun();
			$('#SearchFrm').val(month[0] ).attr('readonly',true);
			$('#SearchTo').val(month.pop() ).attr('readonly',true);
			
		}
		else
		{$('#SearchFrm').val('' ).attr('readonly',false);
			$('#SearchTo').val('' ).attr('readonly',false);
		}
			
		});
		$('#frmSearch').on('submit',function(e){
		e.preventDefault();
		
		
		if($('#SearchFrm').val() && $('#SearchTo').val())
		{$.post('AjaxFiles/AjaxCaseAll.php',{FrmDate:$('#SearchFrm').val(),ToDate:$('#SearchTo').val()},function(r){
			  var t=$("#tblPendingChildrenCases").bootstrapTable('destroy');
			  t.bootstrapTable({ data:JSON.parse(r)});
			});
		}			
		
		
	});
		 
     });
});

function confirmDeleteModal(chidId,childName)
{
	$('#ChildID').val(chidId),$('#ChildName').html(childName),$('#ConfirmQuestionModal').modal('show');

}

function EditDataFormatter(value, row, index) {
	 return [
        '<a class="like btnEditContract"  title="Like" href="new-registrant.php?ID='+row.childId+'">',
        '<i class="fa fa-edit"></i> <span class="label label-primary">تعديل</span>',
        '</a>'
		
        
    ].join('');
	
   
}

function PrintDataFormatter(value, row, index) {
	 return [
        '<a class="like btnEditContract"  title="Like" href="child_case_data_print.php?ChildCaseId='+row.caseId+'" target="_blank">',
        '<i class="fa fa-print"></i> <span class="label label-primary">طباعة</span>',
        '</a>'
		
        
    ].join('');
	
   
}
function DeleteDataFormatter(value, row, index) {
	 return [
        '<a class="like btnEditContract"  title="Like" href="javascript:void(0)" onclick="confirmDeleteModal('+row.childId+',\''+row.ChildFullName+'\')" >',
        '<i class="fa fa-edit"></i> <span class="label label-danger">حذف</span>',
        '</a>'
		
        
    ].join('');
	
   
}



</script>



