 <?php 
	require_once("header-links.php");	
	$sql =  "select * from closedCaseView  where Approval_state=1; ";
$CloseRequests=$pdo->query($sql)->fetchAll();

echo '<script> var jsCloseReqeusts='.json_encode($CloseRequests).';</script>'; 

 
 ?>
 <!-- Breadcomb area Start-->
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
										<h2 id="CurrentScreen">الحالات المغلقة</h2>
										<p id="CurrentScreenDescription"> </p>
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
 <div id="wrapper">
    <div id="page-wrapper">
        <div class="row">
			<br>
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading col-sm-12">
					   <div class=" modalHeader col-sm-6" >الحالات المغلقة</div>
					   <div  id="Counter"class="col-sm-6"> </div>
					</div>
					<div class="panel-body">
						<div class="row">
							<!-- /.col-lg-6 (nested) -->
							<div class="container">
								<div class="row">
									<div class="col-md-12 ">
										<div class="panel panel-default panel-table">	
											<div class="panel-body">
										
												<table class="table table-bordered table-hover table-striped"
														data-toggle="table"
											 data-search="true"
											 data-filter-control="true" 
											 data-show-export="true"
											 data-click-to-select="true"
											 data-toolbar="#toolbar"
											  data-show-pagination-switch="true" data-pagination="true" data-id-field="ID" data-page-size="50"  data-side-pagination="client"
											class="table-responsive " id="tblMdlPendingDiagnoseChildren"	   >
																		<thead>
																				<tr>
																				 <th  data-field="CloseId"  data-width="3%"data-filter-control="input" data-sortable="true">الرقم</th>
													<th data-field="ChildFullName" data-filter-control="input" data-sortable="true" data-width="10%" >اسم الطفل</th>
                                                    <th  data-field="Gender" data-filter-control="select" data-sortable="true" data-width="5%">النوع</th>
													 <th  data-field="DisplacedState" data-filter-control="select" data-sortable="true" data-width="3%">؟نازح</th>
													
													<th  data-field="CareGiverFullName" data-filter-control="input" data-sortable="true" data-width="10%">اسم المُعتني</th>
													<th  data-field="CareGiverPhoneNo" data-filter-control="input" data-sortable="true" data-width="7%">رقم الهاتف</th>
													<th  data-field="ChildAddress" data-filter-control="input" data-sortable="true" data-width="10%"> العنوان</th>
																		
																					<th  data-field="Approval_date" data-filter-control="input" data-sortable="true" data-width="8%"> تاريخ الإغلاق</th>
																					
																					
														
                                                   	<th data-formatter="AnalysisDataFormatter" data-width="4%" > التحليل</th>
													<?php if($UserType==435 || $UserType==436){ ?>
												   	
													  <th data-formatter="reopenFormatter" data-width="4%" >إعادة فتح</th><?php } ?>
													
 
  
								 
								  
																				</tr>
																			</thead>
																			 <tbody >
																			
																			 </tbody>
																		</table>
											 </div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
								 
				</div>
			</div>
        </div>
    </div>
</div>
<div class="modal fade" id="CaseReopenFormModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">تغيير الحالة</h4>
            </div>
			  <form data-toggle="validator" role="form" id="frm_CaseReopenClose">
            <div class="modal-body">
              
				<div class="form-group"> <label for="Customer_id">سبب الإغلاق<span class="rqd"></span> :</label><textarea class="form-control" id="CloseReason" name="CloseReason" rows="3" readonly></textarea></div>
				<div class="form-group"> <label for="Customer_id">سبب إعادة الفتح<span class="rqd"></span> :</label><textarea class="form-control" id="ReopenReason" name="ReopenReason" rows="3" required></textarea></div>
				
                                 
             </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                <button type="submit" id="btnSave" class="btn btn-primary">حفظ</button>
            </div>
			  </form>
        </div>
    </div>
</div>
<?php require_once("footer-links.php");  ?>
	<script>
		$( "#analysis-page" ).addClass( "active" );
		$( "#Interface" ).addClass( "active" );
	</script>
 <script>
 
 $(function(){
	
  var m=$("#tblMdlPendingDiagnoseChildren").bootstrapTable('destroy');
   		m.bootstrapTable({ data:jsCloseReqeusts});
		
	
	});
	
function showReopenCaseModal(CloseId,CloseReason)
{
	$('#CloseReason').val(CloseReason);
	
	$('#CaseReopenFormModal').modal('show');
	$('#frm_CaseReopenClose').on('submit',function(e){
			e.preventDefault();
			$.post('AjaxFiles/AjaxReopenCloaseCase.php',{closeId:CloseId,ReopenReason:$('#ReopenReason').val()},function(r){
			
		     
				   var m=$("#tblMdlPendingDiagnoseChildren").bootstrapTable('destroy');
   		m.bootstrapTable({ data:JSON.parse(r)});
				   $('#CaseReopenFormModal').modal('hide');
	             });
			
		});
}
function AnalysisDataFormatter(value, row, index) {
	 return [
        '<a class="like btnEditCaseClose"  title="Like" href="child-analysis.php?ChildCaseID='+row.caseId+'" target="_blank">',
        '<i class="notika-icon notika-form"></i> <span class="label label-primary">التحليل</span>',
        '</a>'
		
        
    ].join('');
	
   
}



function reopenFormatter(value, row, index) {
	 return [
        '<a class="like btnEditCaseClose"  title="Like" onclick="showReopenCaseModal('+row.CloseId+',\''+row.Reason+'\')" href="javascript:void(0)">',
        '<i class="notika-icon notika-finance"></i> <span class="label label-success">إعادة فتح</span>',
        '</a>'
		
        
    ].join('');
	
   
}


</script>
