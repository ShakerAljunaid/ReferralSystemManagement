<?php 
require_once('header-links.php');
//require_once('RetrieveData2Javascript/retrieve_cmb_data.php');
$sql="SELECT IOMR.*,'إب -الظهار' as FAName,'1' as FANumber,'إب' FAGov,'الظهار' FADst,'' Notes,(CASE WHEN (FindCaseNoOfDaysFrqAct(IOMR.caseId, IOMR.Created_date, NOW()) > 0) THEN 'نعم' ELSE 'لا' END) AS RepeatedVistor FROM IomReportView IOMR";
$FAReport = $pdo->query($sql)->fetchAll();
echo '<script> var JsFAReport='.json_encode($FAReport).'; </script>';

?>
<link rel='stylesheet' href='GrdExp/css/bootstrap-table.min.css'>
<link rel='stylesheet' href='GrdExp/css/bootstrap-editable.css'>
<div class="Agency-fluid fill">
<br />
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
										<h2 id="CurrentScreen">تقرير المساحة</h2>
										<p id="CurrentScreenDescription">التقارير الكامل المطلوب من منظمة الهجرة حسب البيانات المطلوبة</p>
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
    
    <br />
	
	
	 <div id="wrapper">
    <div id="page-wrapper">
        <div class="row">
			<br>
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading col-sm-12">
					   <div class=" modalHeader col-sm-6" ></div>
					   <div  id="Counter"class="col-sm-6"> </div>
					</div>
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
												<table class="table table-bordered table-hover table-striped table-fit" data-toggle="table"  data-search="true"
			 data-filter-control="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar"
			  data-show-pagination-switch="true" data-pagination="true" data-id-field="ID" data-page-size="50"  data-side-pagination="client"
            class="table-responsive" id="FAIOMREPORTGrid">
	   
										<thead>
									
                                                <tr>
												    <th  data-field="ChildFullName" data-filter-control="input" data-sortable="true" data-width="20%">اسم الطفل</th>
													<th  data-field="caseId" data-filter-control="input" data-sortable="true" >الرقم</th>
													  <th  data-field="FAName" data-width="3%" data-filter-control="input" data-sortable="true" >اسم المساحة</th>
													<th  data-field="FANumber" data-width="3%" data-filter-control="input" data-sortable="true" >رقم المساحة</th>
													<th  data-field="FAGov" data-width="3%" data-filter-control="input" data-sortable="true"  >المحافظة</th>
													<th  data-field="FADst" data-width="3%" data-filter-control="input" data-sortable="true"  >المديرية</th>
													<th  data-field="Created_date" data-width="3%" data-filter-control="input" data-sortable="true">تاريخ زيارة المساحة</th>
													<th  data-field="Gender" data-filter-control="input" data-width="3%" data-sortable="true">الجنس</th>
													<th  data-field="Age" data-filter-control="input" data-width="3%" data-sortable="true">العمر</th>
													<th  data-field="NationalityTitle" data-filter-control="input" data-width="3%" data-sortable="true">الجنسية</th>
													<th  data-field="RepeatedVistor" data-filter-control="input" data-width="3%" data-sortable="true">متردد؟</th>
													<th  data-field="DisplacedState" data-filter-control="input" data-width="3%" data-sortable="true">نازح/مضيف/مهاجر/لاجئ </th>
													<th  data-field="Disability_state" data-filter-control="input"  data-width="3%" data-sortable="true">وجود اعاقة</th>
													<th  data-field="DisabilityTitle" data-filter-control="input" data-width="3%" data-sortable="true">نوع الاعاقة</th>
													<th  data-field="PhyscoSupportedOffered" data-filter-control="input" data-width="3%" data-sortable="true" data-width="3%" >الحصول على الدعم النفسي الاجتماعي </th>
													<th  data-field="PhyscoServiceReferral" data-filter-control="input" data-width="3%" data-sortable="true"data-width="3%" >الحصول على جلسات توعية  </th>
													<th  data-field="ConcentratedSupportedOffered" data-filter-control="input" data-width="3%" data-sortable="true"data-width="3%" >الاحالة من اجل الحصول على الدعم النفسي المركز</th>
													<th  data-field="Case_reason" data-filter-control="input" data-width="3%" data-sortable="true">سبب الاحالة </th>
														<th  data-field="diagonistName" data-filter-control="input" data-width="3%" data-sortable="true">اسم الاخصائي النفسي </th>
													<th  data-field="MedicineServiceReferral" data-filter-control="input" data-width="3%" data-sortable="true" data-width="3%">الاحالة من اجل الحصول على ادوات طبية مساعدة  </th>
													<th  data-field="MedicineServices" data-filter-control="input"  data-sortable="true" data-width="3%">نوع الادوات الطبية المساعدة</th>
													<th  data-field="SocailSupportedOffered" data-filter-control="input" data-sortable="true" data-width="3%" >الاحالة لادارة الحالة </th>
													<th  data-field="Protection_issues" data-filter-control="input" data-sortable="true">رصد مشاكل الحماية</th>
													<th  data-field="EchoServiceReferral" data-filter-control="input" data-sortable="true" data-width="3%">الاحالة لتلقي خدمات آخرى</th>
													<th   data-field="EchoServices" data-filter-control="input" data-sortable="true" data-width="3%" >نوع الخدمات الآخرى </th>
													<th   data-field="Notes" data-filter-control="input" data-sortable="true" data-width="3%" >ملاحظات </th>
													
											

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
	

</div>

<?php require_once('footer-links.php');?>

<script src='GrdExp/js/bootstrap-table.js'></script>
<script src='GrdExp/js/bootstrap-table-editable.js'></script>
<script src='GrdExp/js/bootstrap-table-export.js'></script>
<script src='GrdExp/js/tableExport.js'></script>
<script src='GrdExp/js/bootstrap-table-filter-control.js'></script>

<script>

$(document).ready(function(e){
	//Fill data
	var t=$("#FAIOMREPORTGrid").bootstrapTable('destroy');
	
 t.bootstrapTable({ data:JsFAReport}); 
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
		{var t=$("#FAIOMREPORTGrid").bootstrapTable('destroy');
			$.post('AjaxFiles/AjaxIomReportPeriodical.php',{userType:<?php echo $UserType; ?>, FrmDate:$('#SearchFrm').val(),ToDate:$('#SearchTo').val()},function(r){
			
			console.log(JSON.parse(r));
			  t.bootstrapTable({ data:JSON.parse(r)});
			});
		}			
		
		
	});
	
	
	
});






</script>