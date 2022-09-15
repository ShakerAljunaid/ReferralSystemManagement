<?php 
require_once('header-links.php');
 
if(isset($_REQUEST["Case_No"]))
{
$ChildCaseID=$_REQUEST["Case_No"];	

    $sql = 'SELECT childId,ChildFullName,Gender,Age,CareGiverFullName,CareGiverPhoneNo,ChildAddress,caseId,ParentState,Specialist_id,Iom_analyst_id,Iom_analysis_state,childSource,
				CASE WHEN ia.ID IS NULL THEN 0 ELSE ia.ID END AS Analysis_id
				FROM childgridviewdata as chi LEFT OUTER JOIN iomanalysis AS ia ON chi.caseId = ia.Case_id
				WHERE chi.caseId ='.$ChildCaseID; 
	$ChildData = $pdo->query($sql)->fetchAll();
$IomAnalysisState=current($ChildData);
echo '<script> var JsImoAnalysisData;</script>';
if($IomAnalysisState['Iom_analysis_state']>0)
{
	$sql='SELECT * from iomanalysis where Case_id='.$ChildCaseID;
	$IomAnalysisData=$pdo->query($sql)->fetchAll();
	 echo '<script> var JsImoAnalysisData='.json_encode($IomAnalysisData).' ;console.log(JsImoAnalysisData);</script>';
}
      


	 echo '<script> var JsChildData='.json_encode($ChildData).';var ChildCaseID='.$ChildCaseID.'</script>';
}
?>

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
										<h2 id="CurrentScreen">تحليل الحالة</h2>
										<p id="CurrentScreenDescription">شاشة خاصة لمندوب منظمة الهجرة.</p>
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
  
	<div class="row">
    <form data-toggle="validator" role="form" id="frm_iom">
        <div class="row">
  <div class="col-sm-1"></div>
            <!-- List group -->
            <div class="col-sm-10">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-sm-6">تحليل الحالة</div>
                            <div class="wizard-hd">
                            <h2>بيانات الطفل</h2>
                          <div class="child-data">
							   <table class="table table-bordered table-hover table-striped"
								            id="tblCurrentChildData"	   >
										<thead>
                                                <tr>
												    <th  data-field="childId" >الرقم</th>
													<th data-field="ChildFullName"  >اسم الطفل</th>
													<th  data-field="Age" >العمر</th>
                                                    <th  data-field="Gender" >النوع</th>
													<th  data-field="CareGiverFullName" >اسم المُعتني</th>
													<th  data-field="CareGiverPhoneNo" >رقم الهاتف</th>
													<th  data-field="ChildAddress" > العنوان</th>
													<th  data-field="ParentState" > حالة الوالدين</th>
													<th  data-field="childSource" > المصدر</th>
													
													
                                                     <th  data-formatter="PrintReferralFormatter" > بيانات الإحالة</th>
												</tr>
                                            </thead>
                                             <tbody >
											
											 </tbody>
                                        </table>
										</div>
                        </div>
                        </div>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="dataTable_wrapper">
                            <table class="table table-bordered ">
                                <thead>
                                    <tr>
                                        <th width="30%">
                                           العنصر
                                        </th>
                                        <th>
                                            الوصف
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
								
                                    <tr class="odd gradeX">
                                        <td> الخلفية الاسرية والاجتماعية والإقتصادية للطفل</td>
                                       <td class="hidden"><input id="caseId" name="caseId" ></td>
                                        <td>
                                            <p>
                                                <div class="form-group">
                                                    <textarea class="form-control" id="txtFamilyHist" name="txtFamilyHist" rows="3" cols="70" required></textarea>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr class="odd gradeX">
                                        <td> التسلسل الزمني للحالة</td>
                                      
                                        <td><p><div class="form-group"><textarea class="form-control " id="txtChildHist" name="txtChildHist" rows="3" cols="70" required></textarea><div class="help-block with-errors"></div></div></p></td>
                                    </tr>
                                    <tr class="odd gradeX">
                                        <td>  المشاكل والتوقعات التي عبر عنها الحالة</td>
                                       
                                        <td><p><div class="form-group"><textarea class="form-control " id="txtPrblSgs" name="txtPrblSgs" rows="3" cols="70" required></textarea><div class="help-block with-errors"></div></div> </p></td>
                                    </tr>
                                    <tr class="odd gradeX">
                                        <td> الحالة الصحية (جسدية ،نفسية،عقلية) بعد الاستشارة الطبية</td>
                                     
                                        <td><p><div class="form-group"><textarea class="form-control" id="txtHltSt" name="txtHltSt" rows="3" cols="70" required></textarea><div class="help-block with-errors"></div></div>  </p></td>
                                    </tr>
                                    <tr class="odd gradeX">
									
                                        <td> التدخلات التي تم تقديمها عبر المنظمة</td>

                                        <td><p><div class="form-group"><textarea class="form-control " id="txtOrgInvn" name="txtOrgInvn" rows="3" cols="70"></textarea><div class="help-block with-errors"></div></div></p></td>
                                    </tr>
                                   <tr class="odd gradeX">
									
                                        <td> نوع الخدمات الطبية المقترحة</td>

                                        <td><p><div class="form-group"><textarea class="form-control " id="txtSuggestedMedCineEquipment" name="txtSuggestedMedCineEquipment" rows="3" cols="70"></textarea><div class="help-block with-errors"></div></div></p></td>
                                    </tr>
                                   
                                </tbody>
                            </table>
                        
                            <div class="col-lg-4"></div>
						<div class="vw-ml-action-ls text-right mg-t-20">
                            <div class="btn-group ib-btn-gp active-hook nk-email-inbox">
                                <button type="submit" class="btn btn-default btn-sm waves-effect"><i class="notika-icon notika-form"></i> حفظ</button>
                    
                                <button class="btn btn-default btn-sm waves-effect" id="btnPrint"><i class="notika-icon notika-down-arrow"></i> طباعة</button>
                                <a  href="iom_analysis.php" id="btnReset" class="btn btn-default btn-sm waves-effect"><i class="notika-icon notika-trash"></i> تهيئة</a>
                            </div>
                        </div>
                        </div>
                    </div>


                </div>
            </div>
			  <div class="col-sm-1"></div>
            <!-- /.panel -->
            <!-- /.col-sm-12 -->
        </div>
		</form>
		</div>

	

<!-- Modal -->

</div>

<?php require_once('footer-links.php');?>
<script>
 $(document).ready(function(){
	 if(JsImoAnalysisData)
	 {
		 $.each(JsImoAnalysisData,function(k,i){
			 $('#txtFamilyHist').val(i.Family_bg),
			 $('#txtChildHist').val(i.State_history),
			 $('#txtPrblSgs').val(i.Problems_suggestions),
			 $('#txtHltSt').val(i.Child_total_state),
			 $('#txtOrgInvn').val(i.Org_prv_interventions)
			  $('#txtSuggestedMedCineEquipment').val(i.Suggested_medicine_equipment)
	
		 });
		 
	 }
	 $('#caseId').val(ChildCaseID);
	 var v=$("#tblCurrentChildData").bootstrapTable('destroy');
		v.bootstrapTable({ data:JsChildData});
	 console.log(JsChildData);
	 $('#frm_iom').on("submit",function(e){e.preventDefault(); let data=$('#frm_iom').serializeArray() ;
	 console.log(data);
	 $.post('AjaxFiles/AjaxNewIomAnalysis.php',data,function(r){
		 console.log(r)
		 if(parseInt(r)>0)
				{mkNoti('تم', 'تم الحفظ بنجاح! ', { status: 'success' })}
			else
				mkNoti('خطأ', 'الرجاء التأكد من صحة البيانات! ', { status: 'danger' });
	 });
	  });
	
	 
	$('#btnPrint').on('click',function(e){
		 window.open('iom_analysisPrint.php?Case_No='+ChildCaseID);
		
	}); 
 });
function PrintReferralFormatter(value,row,index)
{   return [ '<a class="like btnEditContainer"  title="Like" href="analysis_data_print.php?ChildCaseId='+ChildCaseID+'" target="_blank">',
        '<i class="fa fa-edit"></i> <span class="label label-primary">بيانات الإحالة</span>',
        '</a>'
		
        
    ].join('');
	
}



</script>

