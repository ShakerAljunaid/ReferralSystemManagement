 <?php 
	require_once("header-links.php");	         

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
										<h2 id="CurrentScreen">الحالات المعلقة</h2>
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
					   <div class=" modalHeader col-sm-6" >جميع الحالات المعلقة</div>
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
											class="table-responsive " id="tblMdlPendingChildren"	   >
																		<thead>
																				<tr>
																				 <th  data-field="childId" data-filter-control="input" data-sortable="true">الرقم</th>
																					<th data-field="ChildFullName" data-filter-control="input" data-sortable="true" >اسم الطفل</th>
																					<th  data-field="Gender" data-filter-control="input" data-sortable="true">النوع</th>
																					 <th  data-field="DisplacedState" data-filter-control="select" data-sortable="true">نازح؟</th>
																					<th  data-field="CareGiverFullName" data-filter-control="input" data-sortable="true">اسم المُعتني</th>
																					<th  data-field="CareGiverPhoneNo" data-filter-control="input" data-sortable="true">رقم الهاتف</th>
																					<th  data-field="ChildAddress" data-filter-control="input" data-sortable="true"> العنوان</th>
																					<th  data-field="AnalysisDate" data-filter-control="input" data-sortable="true"> تاريخ الانشاء</th>
																					<th data-formatter="SubmitFormatter" >استلام الحالة</th>
																					
																					
								 
								  
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
	 
  var pl=$("#tblMdlPendingChildren").bootstrapTable('destroy');
   	pl.bootstrapTable({ data:JsPendingChildrenCases});
	
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
		{$.post('AjaxFiles/AjaxCase4Analysis.php',{State:0,FrmDate:$('#SearchFrm').val(),ToDate:$('#SearchTo').val()},function(r){
			  var m=$("#tblMdlPendingChildren").bootstrapTable('destroy');
			  m.bootstrapTable({ data:JSON.parse(r)});
			});
		}			
		
		
	});
		
	});
 
function SubmitFormatter(value, row, index) {
	 return [
        '<a class="like btnEditContract"  title="Like" href="child-analysis.php?ChildCaseID='+row.caseId+'">',
        '<i class="fa fa-edit"></i> <span class="label label-primary">إستلام</span>',
        '</a>'
		
        
    ].join('');
	
   
}

</script>
