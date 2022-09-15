
<?php 
require_once("header-links.php");
require('AjaxFiles/AjaxAssignCaseSpecist.php');
require('AjaxFiles/AjaxRetriveCaseAnalysis.php');
?>
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
										<h2 id="CurrentScreen">تحليل حالة الطفل</h2>
										<p id="CurrentScreenDescription">يقوم الاخصائي النفسي بتحليل حالة الطفل ومن ثم إتخاذ قرار الإحالة المناسب.</p>
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
                <div class="col-lg-8">
                   <center> <h3 class="page-header">تحليل الحالة</h3></center>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
			<div class="col-lg-2" ></div>
               <div class="col-lg-8">
                    <div class="panel panel-default">
                      
                        <div class="panel-body">
				 <form role="form" id="frm_child_analysis"  method="POST"  data-toggle="validator" role="form">
				 <input type="hidden" id="IsAnalysisExist" name="IsAnalysisExist" value="0" />
				 <div class="childInfo">
				   <div class="col-lg-12">
				    <div class="panel panel-default">
				      <div class="panel-heading">
                          بيانات الطفل
                        </div>
						
						 <div class="panel-body">
						 <div class="row ">
							   <div class="child-data">
							   <table class="table table-bordered table-hover table-striped"
								            id="tblCurrentChildData"	   >
										<thead>
                                                <tr>
												    <th  data-field="childId" >الرقم</th>
													<th data-field="ChildFullName"  >اسم الطفل</th>
                                                    <th  data-field="Gender" >النوع</th>
													<th  data-field="CareGiverFullName" >اسم المُعتني</th>
													<th  data-field="CareGiverPhoneNo" >رقم الهاتف</th>
													<th  data-field="ChildAddress" > العنوان</th>
													<th  data-field="ParentState" > حالة الوالدين</th>
                                                     
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
				 <div class="childInfo">
				   <div class="col-lg-12">
				    <div class="panel panel-default">
				      <div class="panel-heading">
                           سبب  طلب الإحالة
                        </div>
						
						 <div class="panel-body">
						 <div class="row">
							   
								  <div class="form-group">
                                                 <textarea class="form-control" rows="3" id="CaseAnalysisCaseReason" name="CaseAnalysisCaseReason" required></textarea>
                                </div>
								  
								 
								 </div>
								 </div>
				
				          </div>
				         </div>
					</div>	
      <div class="childInfo">
				   <div class="col-lg-12">
				    <div class="panel panel-default">
				      <div class="panel-heading">
                           حالة معيشة الطفل
                        </div>
						
						 <div class="panel-body">
					
							   
								  <div class="form-group">
                                            <label>المعيشة:</label>
                                            
										
										
                                          <div class="">
										  <table class="table table-striped ">
										
										  <tbody>
										  <tr>
										  <td>  <input type="radio" name="rdbCaseAnalysisLivingStatus" id="rdbCaseAnalysisLivingStatus1" value="1" checked></td>
										  <td> يعيش مع والدية</td>
										  <td> <input type="radio" name="rdbCaseAnalysisLivingStatus" id="rdbCaseAnalysisLivingStatus2" value="2" ></td>
										      <td>يعيش مع امه</td>
											    <td> <input type="radio" name="rdbCaseAnalysisLivingStatus" id="rdbCaseAnalysisLivingStatus3" value="3" ></td>
										      <td>يعيش مع ابوه</td>
											 </tr>
											  <tr>
										  <td> <input type="radio" name="rdbCaseAnalysisLivingStatus" id="rdbCaseAnalysisLivingStatus4" value="4" ></td>
										  <td> يعيش مع اخ بالغ</td>
										  <td><input type="radio" name="rdbCaseAnalysisLivingStatus" id="rdbCaseAnalysisLivingStatus5" value="5" ></td>
										      <td>يعيش مع قريب من الأسرة</td>
											    <td> <input type="radio" name="rdbCaseAnalysisLivingStatus" id="rdbCaseAnalysisLivingStatus6" value="6" ></td>
										      <td>يعيش مع شخص بالغ من خارج الأسرة</td>
											 </tr>
											 
											  <tr>
										  <td> <input type="radio" name="rdbCaseAnalysisLivingStatus" id="rdbCaseAnalysisLivingStatus7" value="7" ></td>
										  <td> يعيش في مؤسسة (بعيد عن الأسرة)</td>
										  <td> <input type="radio" name="rdbCaseAnalysisLivingStatus" id="rdbCaseAnalysisLivingStatus8" value="8" ></td>
										      <td>يعيش في مدرسة</td>
											    <td> <input type="radio" name="rdbCaseAnalysisLivingStatus" id="rdbCaseAnalysisLivingStatus9" value="9" ></td>
										      <td>يعيش في الشارع</td>
											 </tr>
											   <tr>
										  <td> <input type="radio" name="rdbCaseAnalysisLivingStatus" id="rdbCaseAnalysisLivingStatus10" value="10" ></td>
										  <td> يعيش مع الوالدين او احدهما في الشارع</td>
										  <td> <input type="radio" name="rdbCaseAnalysisLivingStatus" id="rdbCaseAnalysisLivingStatus11" value="11" ></td>
										      <td>يتيم يعش مع اسرة اخرى</td>
											    <td> <input type="radio" name="rdbCaseAnalysisLivingStatus" id="rdbCaseAnalysisLivingStatus12" value="12" ></td>
										      <td>يتيم يعيش في المدرسة</td>
											 </tr>
											 </tbody>
										  </table>
										  </div>
										  <div class="form-group">
                                            <label>حالة الطفل:</label>
                                            
										
										
                                          <div class="">
										  <table class="table table-striped ">
										
										  <tbody>
											   <tr>
										  <td> <input type="radio" name="rdbCaseAnalysisVictimState" id="rdbCaseAnalysisVictimState1" value="1"  checked></td>
										  <td>ضحية انتهاك جسدي</td>
										  <td><input type="radio" name="rdbCaseAnalysisVictimState" id="rdbCaseAnalysisVictimState2" value="2" ></td>
										      <td>ضحية انتهاك جنسي</td>
											    <td> <input type="radio" name="rdbCaseAnalysisVictimState" id="rdbCaseAnalysisVictimState3" value="3" ></td>
										      <td>ضحية إتجار</td>
											 </tr>
											   <tr>
										  <td> <input type="radio" name="rdbCaseAnalysisVictimState" id="rdbCaseAnalysisVictimState4" value="4" ></td>
										  <td>ضحية إهمال</td>
										  <td></td>
										      <td></td>
											    <td> </td>
										      <td></td>
											 </tr>
										  </tbody>
										  </table>
										  </div>
                                           
                                        </div>
										<div class="form-group">
                                            <label>المشكلة الحالية:</label>
                                            
										
										
                                          <div class="">
										  <table class="table table-striped ">
										
										  <tbody>
										  <tr>
										  <td>  <input type="radio" name="rdbtnCurrentIssue" id="rdbtnCurrentIssue1" value="1" checked></td>
										  <td> معانة الطفل</td>
										  <td> <input type="radio" name="rdbtnCurrentIssue" id="rdbtnCurrentIssue2" value="2" ></td>
										      <td>طفل معاق</td>
											    <td> <input type="radio" name="rdbtnCurrentIssue" id="rdbtnCurrentIssue3" value="3" ></td>
										      <td>المُعتني بالطفل يعني من إعاقة او مرض دائم</td>
											 </tr>
											  <tr>
										  <td> <input type="radio" name="rdbtnCurrentIssue" id="rdbtnCurrentIssue4" value="4" ></td>
										  <td> زواج مبكر</td>
										  <td><input type="radio" name="rdbtnCurrentIssue" id="rdbtnCurrentIssue5" value="5" ></td>
										      <td>مخالف القانون</td>
											    <td> <input type="radio" name="rdbtnCurrentIssue" id="rdbtnCurrentIssue6" value="6" ></td>
										      <td>مدمن مخدرات او مواد اخرى</td>
											 </tr>
											 
											  <tr>
										  <td> <input type="radio" name="rdbtnCurrentIssue" id="rdbtnCurrentIssue7" value="7" ></td>
										  <td> ضحية لإستغلال جنسي تجاري</td>
										  <td> <input type="radio" name="rdbtnCurrentIssue" id="rdbtnCurrentIssue8" value="8" ></td>
										      <td>تاريخ الميلاد غير مسجل</td>
											    <td> <input type="radio" name="rdbtnCurrentIssue" id="rdbtnCurrentIssue9" value="9" ></td>
										      <td></td>
											 </tr>
											 
											 
										  </tbody>
										  </table>
										   <label>مشاكل اخرى:</label>
										  <div class="form-group">
                                                 <textarea class="form-control" name="CaseAnalysisOtherIssues" id="CaseAnalysisOtherIssues" rows="3"></textarea>
                                        </div>
										  </div>
                                           
                                        </div>
                                     
                                      
								 
								 </div>
							</div>
				
				          </div>
				         </div>
					</div>	 					
							   
							   <div class="childInfo">
				   <div class="col-lg-12">
				     <div class="panel panel-default">
				      <div class="panel-heading">
                          الإجراء المقترح من قبل مدير الإحالة
                        </div>
						
						 <div class="panel-body">
						 <div class="row">
							   
								  <div class="form-group">
                                                 <textarea class="form-control" name="CaseAnalysisSuggestedPrcByReferralManager" id="CaseAnalysisSuggestedPrcByReferralManager" rows="3" required></textarea>
                                        </div>
								  
								 
								 </div>
								 </div>
				
				          </div>
				         </div>
							   </div>	
							      
							   <div class="childInfo">
				   <div class="col-lg-12">
				     <div class="panel panel-default">
				      <div class="panel-heading">
                          الإجراء المقترح من قبل المختص النفسي
                        </div>
						
						 <div class="panel-body">
						 <div class="row">
							   
								  <div class="form-group">
                                                 <textarea class="form-control" name="CaseAnalysisSuggestedPrcByPhsycoSpecialist" id="CaseAnalysisSuggestedPrcByPhsycoSpecialist" rows="3" required></textarea>
                                        </div>
								  
								 
								 </div>
								 </div>
				
				          </div>
				         </div>
							   </div>	
							    <div class="childInfo">
				   <div class="col-lg-12">
				     <div class="panel panel-default">
				      <div class="panel-heading">
                         الخدمات المقترح تقديمها للحالة
                        </div>
						
						 <div class="panel-body">
						 <div class="row">
							   
								  <div class="form-group">
                                      <textarea name="CaseAnalysisSuggestedServices" id="CaseAnalysisSuggestedServices" class="form-control" rows="3" required></textarea>
                                   </div>
								  
								 
								 </div>
								 </div>
				
				          </div>
				         </div>
							   </div>	
							   
			
						
					
						<div class="col-lg-4"></div>
						<button type="submit" class="btn btn-primary">حفظ البيانات</button>
                           
						   <button type="reset" class="btn btn-danger">إعادة تهيئة</button>
						</form>
						<button type="button" id="btnExternalReferral" class="btn btn-primary">إحالة خارجية</button>
                           
						   <button type="reset" class="btn btn-danger">تقديم خدمات</button>
				
				 </div>
			
				
				
				
                    
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    </div>
    <!-- /#wrapper -->
	<div class="modal fade" id="ExternalReferralFormModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">إحالة خارجية</h4>
            </div>
            
                <form data-toggle="validator" role="form" id="frm_Agency">
					<div class="modal-body">
						<input type="hidden" id="ExternalreferralId" name="ExternalreferralId" value="0" />
						<div class="form-group"> <label for="Party_id">الجهة: <span class="rqd">*</span> :</label><select class="form-control" id="Party_id" name="Party_id"  required><option value="1">Save the children</option></select></div>
						<div class="form-group"> <label for="ContractId">اسم الشخص المرسل إليه:<span class="rqd">*</span> :</label><select type="text" class="form-control" id="ReceiverPersonName" name="ReceiverPersonName"  required>
						<option value="1">احمد سعد عبدالله</option><option value="2">ابراهيم</option></select></div>
						<div class="form-group"> <label for="Customer_id">ملاحظات<span class="rqd"></span> :</label><textarea class="form-control" id="ExternalreferralNote" name="ExternalreferralNote" rows="3" required></textarea></div>
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
	
	
	var v=$("#tblCurrentChildData").bootstrapTable('destroy');
		v.bootstrapTable({ data:JsChildData});
$('#frm_child_analysis').on('submit', function (e) {
			 var dataS=$('#frm_child_analysis').serializeArray();
			 
			  dataS.push({'name':'ChildCaseId','value':'<?php echo isset($param["ChildCaseID"])?$param["ChildCaseID"]:$param["Case_No"]; ?>'});
			   console.log(dataS);
			e.preventDefault();
			$.post('AjaxFiles/AjaxNewChildCaseAnalysis.php',dataS,function(r){
				alert(r);
				//i must set the IsAnalysisExist to true to tell the database that this analysis is exist 
				//( to prevent the duplications of records if the user tried to save the form without refreshing the page)
				if(r != '0')
				$("#IsAnalysisExist").val('1');
			});
		});
$('#frm_Agency').on('submit', function (e) {
			 var dataS=$('#frm_Agency').serializeArray();
			 
			  dataS.push({'name':'ChildCaseId','value':'<?php echo isset($param["ChildCaseID"])?$param["ChildCaseID"]:$param["Case_No"]; ?>'});
			   console.log(dataS);
			e.preventDefault();
			$.post('AjaxFiles/AjaxNewExternalReferralCase.php',dataS,function(r){
				console.log(r);
				//i must set the IsAnalysisExist to true to tell the database that this analysis is exist 
				//( to prevent the duplications of records if the user tried to save the form without refreshing the page)
				if(r != '0'){
					$.each(JSON.parse(r),function(k,i)
					{
						$("#ExternalreferralId").val(i.erc_Id);
					 });
					 $('#ExternalReferralFormModal').modal('hide');
				 }
			});
		});
$('#btnExternalReferral').on('click',function(e){
	$('#frm_child_analysis').submit();
	$('#ExternalReferralFormModal').modal('show');
	
});        


});
</script>
<script>
$(function(){
	if(JsCaseData != '1'){
		$.each(JsCaseData,function(k,i)
        {
			$("#CaseAnalysisCaseReason").val(i.Case_reason);
			if(i.Living_status == 1)
				$("#rdbCaseAnalysisLivingStatus1"). prop("checked", true);
			else if(i.Living_status == 2)
				$("#rdbCaseAnalysisLivingStatus2"). prop("checked", true);
			else if(i.Living_status == 3)
				$("#rdbCaseAnalysisLivingStatus3"). prop("checked", true);
			else if(i.Living_status == 4)
				$("#rdbCaseAnalysisLivingStatus4"). prop("checked", true);
			else if(i.Living_status == 5)
				$("#rdbCaseAnalysisLivingStatus5"). prop("checked", true);
			else if(i.Living_status == 6)
				$("#rdbCaseAnalysisLivingStatus6"). prop("checked", true);
			else if(i.Living_status == 7)
				$("#rdbCaseAnalysisLivingStatus7"). prop("checked", true);
			else if(i.Living_status == 8)
				$("#rdbCaseAnalysisLivingStatus8"). prop("checked", true);
			else if(i.Living_status == 9)
				$("#rdbCaseAnalysisLivingStatus9"). prop("checked", true);
			else if(i.Living_status == 10)
				$("#rdbCaseAnalysisLivingStatus10"). prop("checked", true);
			else if(i.Living_status == 11)
				$("#rdbCaseAnalysisLivingStatus11"). prop("checked", true);
			else if(i.Living_status == 12)
				$("#rdbCaseAnalysisLivingStatus12"). prop("checked", true);
				
			if(i.Victim_state == 1)
				$("#rdbCaseAnalysisVictimState1"). prop("checked", true);
			else if(i.Victim_state == 2)
				$("#rdbCaseAnalysisVictimState2"). prop("checked", true);
			else if(i.Victim_state == 3)
				$("#rdbCaseAnalysisVictimState3"). prop("checked", true);
			else if(i.Victim_state == 4)
				$("#rdbCaseAnalysisVictimState4"). prop("checked", true);
				
			if(i.Current_problem == 1)
				$("#rdbtnCurrentIssue1"). prop("checked", true);
			else if(i.Current_problem == 2)
				$("#rdbtnCurrentIssue2"). prop("checked", true);
			else if(i.Current_problem == 3)
				$("#rdbtnCurrentIssue3"). prop("checked", true);
			else if(i.Current_problem == 4)
				$("#rdbtnCurrentIssue4"). prop("checked", true);
			else if(i.Current_problem == 5)
				$("#rdbtnCurrentIssue5"). prop("checked", true);
			else if(i.Current_problem == 6)
				$("#rdbtnCurrentIssue6"). prop("checked", true);
			else if(i.Current_problem == 7)
				$("#rdbtnCurrentIssue7"). prop("checked", true);
			else if(i.Current_problem == 8)
				$("#rdbtnCurrentIssue8"). prop("checked", true);
			else if(i.Current_problem == 9)
				$("#rdbtnCurrentIssue9"). prop("checked", true);
				
			$("#CaseAnalysisOtherIssues").val(i.Other_issues);
			$("#CaseAnalysisSuggestedPrcByReferralManager").val(i.Suggested_prc_by_referral_manager);
			$("#CaseAnalysisSuggestedPrcByPhsycoSpecialist").val(i.Suggested_prc_by_phsyco_specialist);
			$("#CaseAnalysisSuggestedServices").val(i.Suggested_services);
			//i set the IsAnalysisExist to true to tell the database that this analysis is already there when the form submit
			$("#IsAnalysisExist").val('1');
	     });
	}
	
	if(JsExternalData != '1'){
		$.each(JsExternalData,function(k,i)
        {
			$("#ExternalreferralId").val(i.erc_Id);
			$("#Party_id").val(i.Agency_id);
			$("#ReceiverPersonName").val(i.Agency_person_id);
			$("#ExternalreferralNote").val(i.Note);
	     });
	}
});

</script>