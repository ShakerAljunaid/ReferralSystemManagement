<?php 
require_once('header-links.php');
//require_once('RetrieveData2Javascript/retrieve_cmb_data.php');
   $sql = 'SELECT  *,FindCaseNoOfDaysFrqAct(childCaseId,"2019-06-01",now()) as NoOfFrequencies,case when FindCaseNoOfDaysFrqAct(childCaseId,"2019-06-01",now()) >1 then "نعم" else "لا" end as FrequencyState from  allofferedactivities '; 
   if($UserType!=436 && $UserType!=524 ){
    $sql .=' where Created_user_id='.$UserId;
    if($UserType==433)
		$sql .=' and Service_id=10;';
 }
  
$ChildActivity = $pdo->query($sql)->fetchAll();
echo '<script> var JsChildActivity='.json_encode($ChildActivity).'; </script>';

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
										<h2 id="CurrentScreen">تقرير الأنشطة</h2>
										<p id="CurrentScreenDescription">يمكنك البحث عن جميع النشاطات التي تم تقديمها للمستفيدين مع امكانية التصفية بجميع المتغيرات.</p>
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
	<div  class="col-md-2"></div>
	<div class="col-md-8" >
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
	<table class="table table-bordered table-hover table-striped" data-toggle="table"  data-search="true"
			 data-filter-control="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar"
			  data-show-pagination-switch="true" data-pagination="true" data-id-field="ID" data-page-size="50"  data-side-pagination="client"
            class="table-responsive" id="CaseActivityGrid">
	   
										<thead>
									
                                                <tr>
												    <th  data-field="Case_id" data-width="3%" data-filter-control="input" data-sortable="true">الرقم</th>
													<th  data-field="FullName" data-filter-control="input" data-sortable="true" data-width="15%">اسم الطفل</th>
													<th  data-field="ChildGender" data-filter-control="select" data-sortable="true">النوع</th>
													<th  data-field="FrequencyState" data-filter-control="select" data-sortable="true">متردد؟</th>
													<th  data-field="Age" data-filter-control="select" data-sortable="true">العمر</th>
													<th  data-field="DiplacedState" data-filter-control="select" data-sortable="true">نازح؟</th>
													<th  data-field="ServiceTitle" data-filter-control="select" data-sortable="true">اسم الخدمة</th>
													<th  data-field="ActivityTitle" data-filter-control="input" data-sortable="true">النشاط</th>
													<th  data-field="NoOfFrequencies" data-filter-control="input" data-sortable="true">عدد الزيارات</th>
													<th  data-field="Rate" data-filter-control="select" data-sortable="true">التقييم</th>
													
													<th   data-field="Day_date" data-filter-control="input" data-sortable="true" >تاريخ التقديم</th>
													
								

												</tr>
                                            </thead>
                                             <tbody >
											
											 </tbody>
                                        </table>
  
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
	var t=$("#CaseActivityGrid").bootstrapTable('destroy');
	
 t.bootstrapTable({ data:JsChildActivity}); 
 
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
		{$.post('AjaxFiles/AjaxCaseCaseActivityReportPeriodical.php',{userType:<?php echo $UserType; ?>,userId:<?php echo $UserId; ?>, FrmDate:$('#SearchFrm').val(),ToDate:$('#SearchTo').val()},function(r){
			var t=$("#CaseActivityGrid").bootstrapTable('destroy');
			  t.bootstrapTable({ data:JSON.parse(r)});
			});
		}			
		
		
	});
	
	
});






</script>