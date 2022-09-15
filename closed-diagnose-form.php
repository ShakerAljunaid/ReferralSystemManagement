 <?php 
	require_once("header-links.php");	
	 $sql = 'SELECT  * from  childGridViewData where Diagonse_state!=0 and Diagnose_closed =1';
if($UserType!=436)		
      $sql .=' and diagnonist_id='.$_SESSION["user_id"]; 
	$ChildData = $pdo->query($sql)->fetchAll();
echo '<script> var JsPendingDiagnoseChildrenCases2='.json_encode($ChildData).';</script>';
 
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
										<h2 id="CurrentScreen">الحالات المستلمة</h2>
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
					   <div class=" modalHeader col-sm-6" >جميع الحالات المستلمة</div>
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
																				 <th  data-field="childId" data-filter-control="input" data-sortable="true">الرقم</th>
																					<th data-field="ChildFullName" data-filter-control="input" data-sortable="true" >اسم الطفل</th>
																					<th  data-field="Gender" data-filter-control="input" data-sortable="true">النوع</th>
																					<th  data-field="CareGiverFullName" data-filter-control="input" data-sortable="true">اسم المُعتني</th>
																					<th  data-field="CareGiverPhoneNo" data-filter-control="input" data-sortable="true">رقم الهاتف</th>
																					<th  data-field="ChildAddress" data-filter-control="input" data-sortable="true"> العنوان</th>
																					<th  data-field="DiagnoseDate" data-filter-control="input" data-sortable="true"> تاريخ الانشاء</th>
																					<th data-formatter="SubmitFormatter" >إعادة فتح</th>
																					
																					
								 
								  
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
<?php require_once("footer-links.php");  ?>
	<script>
		$( "#analysis-page" ).addClass( "active" );
		$( "#Interface" ).addClass( "active" );
	</script>
 <script>
 
 $(function(){
	
  var m=$("#tblMdlPendingDiagnoseChildren").bootstrapTable('destroy');
   		m.bootstrapTable({ data:JsPendingDiagnoseChildrenCases2});
	
	});
	
function reopenCase(CaseId)
{
	$.post('AjaxFiles/AjaxReopenDiagnose.php',{userId:<?php echo $UserId; ?>,caseId:CaseId},function(r){
		
		var m=$("#tblMdlPendingDiagnoseChildren").bootstrapTable('destroy');
   		m.bootstrapTable({ data:JSON.parse(r)});
		  window.open("child-initial-diagnose.php?Case_No="+CaseId); 
		});
}
function SubmitFormatter(value, row, index) {
	 return [
        '<a class="like btnEditContract"  title="Like" href="javascript:void(0);" onclick="reopenCase('+row.caseId+')">',
        '<i class="fa fa-open"></i> <span class="label label-primary">إعادة فتح</span>',
        '</a>'
		
        
    ].join('');
	
   
}


</script>
