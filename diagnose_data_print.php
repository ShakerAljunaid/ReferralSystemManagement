<?php 
require_once('print_header.php');require_once('dbconfig.php');

if(isset($_REQUEST["Case_No"])){
		$sql = 'SELECT childId,ChildFullName,Gender,CareGiverFullName,CareGiverPhoneNo,ChildAddress,caseId,ParentState,Specialist_id,
				CASE WHEN ini.ID IS NULL THEN 0 ELSE ini.ID END AS Diagnose_id, Main_complaint,Reasons,Taken_actions,Recommendations,Suggestions,
				other_Behaviors,Behaviors_Desc,Detailed_Diagnoses,Behavior_Degree,Important_Behaviors,Performance_Degree,
				Behaviors_Period,Diagnose_Date,Other_Factors,Factors_Desc,Suicide,Violence,Addiction,Medical_Problems,
				Knowledge_Assessment,Psych_Drugs,Assessment_Note
				FROM childgridviewdata as chi LEFT OUTER JOIN initialdiagnose AS ini ON chi.caseId = ini.Case_id
				WHERE chi.caseId ='.$_REQUEST["Case_No"]; 
		 $ChildData = $pdo->query($sql)->fetchAll();
		 echo '<script> var JsChildData='.json_encode($ChildData).';var ChildID='.$_REQUEST["Case_No"].'</script>';
	
$CDiagnose_id = current($ChildData)["Diagnose_id"];

$sql =  "SELECT mlist.ID, mlist.Title, mlist.Parent_id, pList.Title AS parent_title, mlist.List_type_id, CASE WHEN bhvr.ID is NULL THEN '' ELSE 'checked' END AS chk FROM manylist AS mlist
INNER JOIN manylist AS pList ON mlist.Parent_id = pList.ID
LEFT OUTER JOIN initialdiagnose_behavior as bhvr ON bhvr.Intial_diagnose_id = ".$CDiagnose_id."  AND mlist.ID = bhvr.Behavior_id
where mlist.List_type_id IN(19, 22, 24) AND mlist.Parent_id NOT IN(423, 424)
ORDER BY mlist.List_type_id, mlist.Parent_id, mlist.ID;";
$ManyListData=$pdo->query($sql)->fetchAll();
$Tab2="";
$Tab3="";
$Tab4="";

$Pindex=0;
$Aindex=0;
$LastRowParentId = 0;
$LastRowListTypeId = 0;
$TempRowData = '';
foreach ($ManyListData as $md)
{
	if($md['Parent_id'] != $LastRowParentId){
		if($LastRowParentId != 0){
			for($x = ($Aindex%3); $x > 0 && $x < 3; $x++)
				$TempRowData.="<td></td>";
			
			$TempRowData .= '</tr></tbody></table></div></div>';
			if($LastRowListTypeId == 19)
				$Tab2 .= $TempRowData;
			else if($LastRowListTypeId == 24)
				$Tab3 .= $TempRowData;
			else if($LastRowListTypeId == 22)
				$Tab4 .= $TempRowData;
			
			$TempRowData = '';
		}
		$Aindex = 0;
		$TempRowData .= "<div class='form-group'><div class='row'><label>";
		$TempRowData .= $md['parent_title'];
		$TempRowData .= '</label>';
		if($md['List_type_id'] == 24){
			$TempRowData .= "<div calss='col-xs-12 col-md-6 col-lg-6'><input type='date' class='form-control' name='ind_Diagnose_Date' id='ind_Diagnose_Date' /> </div></div>";
		}
		$TempRowData .= "<div><table class='table table-bordered table-striped'><tbody><tr>";
	}
	if(($Aindex%3)==0)
		$TempRowData.='</tr><tr>';
	$TempRowData.="<td class='BehaviorRow'><input type='checkbox' class='i-checks checkBehavior' name='checkBehavior' ".$md['chk']."> <input type='hidden' id='BehaviorId' name='BehaviorId' value='".$md['ID']."'></td><td> ".$md['Title']."</td>";
     $Aindex++;
	
	$LastRowListTypeId = $md['List_type_id'];
	$LastRowParentId = $md['Parent_id'];
}
$TempRowData .= '</tr></tbody></table></div></div>';
if($LastRowListTypeId == 19)
	$Tab2 .= $TempRowData;
else if($LastRowListTypeId == 24)
	$Tab3 .= $TempRowData;
else if($LastRowListTypeId == 22)
	$Tab4 .= $TempRowData;

$sql =  "SELECT sa.ID,Title, CASE WHEN sgSrvAc.ID is NULL THEN '' ELSE 'checked' END AS chk
FROM serviceactivity AS sa LEFT OUTER JOIN initialdiagnose_suggestedserviceactivity as sgSrvAc ON sgSrvAc.Intial_diagnose_id = ".$CDiagnose_id." AND sa.ID = sgSrvAc.Activity_id
WHERE sa.Service_id = 10 ORDER BY sa.ID;";
$ActivityData=$pdo->query($sql)->fetchAll();
$ActivityStringData="<tbody><tr>";
$index=0;

foreach ($ActivityData as $md)
{
	if(($index%3)==0)
		$ActivityStringData.='</tr><tr>';
	$ActivityStringData.="<td class='ActivityRow'><input type='checkbox' class='i-checks checkAtivity' name='checkActivity' ".$md['chk']."> <input type='hidden' id='ActivityId' name='ActivityId' value='".$md['ID']."'></td><td> ".$md['Title']."</td>";
$index++;
}
//$PhysioData.='</tr></tbody>';
//$AnotherData.='</tr></tbody>';
$ActivityStringData.='</tr></tbody>';

 echo '<script> var CaseID="'.$_REQUEST["Case_No"].'";var sfdff = '.$CDiagnose_id.';var jsTab2="'.$Tab2.'";var jsTab3="'.$Tab3.'";var jsTab4="'.$Tab4.'";var jsServiceData="'.$ActivityStringData.'";</script>'; 

 
}
?>


    <div id="wrapper">
 	 <div class="disabled wizard-area">
        <div class="disabled container">
            <div class="disabled row">
                <div class="disabled col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="disabled wizard-wrap-int">
                        <div class="disabled wizard-hd">
                            <h2>بيانات الطفل</h2>
                          <div class="disabled child-data">
							   <table class="disabled table table-bordered table-hover table-striped"
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
                        <form role="form" id="frm_child_analysis"  method="POST"  data-toggle="validator" role="form">
				                    <input type="hidden" id="Diagnose_id" name="Diagnose_id" value="0" />
                            <div class="disabled tab-content">
                               
                                <div class="disabled " id="tab1">
									<div class="disabled panel panel-default">
									  <div class="disabled panel-heading">
										  الشكوى الرئيسية
										</div>
										
										 <div class="disabled panel-body">
											<div class="disabled row">
											   
												 <div class="disabled form-group">
													<textarea class="disabled form-control" name="ind_main_complaint" id="ind_main_complaint" rows="2" ></textarea>
												</div>
												  
												 
											</div>
										</div>
								
									</div>
									<div class="disabled col-lg-12">
										<div class="disabled panel panel-default">
										  <div class="disabled panel-heading">
											  الاسباب
											</div>
											
											 <div class="disabled panel-body">
											 <div class="disabled row">
												   
													  <div class="disabled form-group">
																	 <textarea class="disabled form-control" name="ind_reasons" id="ind_reasons" rows="3" ></textarea>
															</div>
													  
													 
													 </div>
													 </div>
									
										</div>
									</div>
								</div>
								  <div class="disabled panel-heading">
											 الاعراض
											</div>
											
								 <div class="disabled " id="tab2">
									
									<div class="disabled panel panel-default">
									  <div class="disabled panel-heading">
										  اعراض اخرى
										</div>
										
										 <div class="disabled panel-body">
											<div class="disabled row">
											   
												 <div class="disabled form-group">
													<textarea class="disabled form-control" name="ind_other_Behaviors" id="ind_other_Behaviors" rows="2" ></textarea>
												</div>
												  
												 
											</div>
										</div>
								
									</div>
									 
									
									<div class="disabled col-lg-12">
										<div class="disabled panel panel-default">
										  <div class="disabled panel-heading">
											  معظم هذه الاعراض تنتمي الى
											</div>
											
											 <div class="disabled panel-body">
											 <div class="disabled row">
												   
													  <div class="disabled form-group">
																	 <textarea class="disabled form-control" name="ind_Behaviors_Desc" id="ind_Behaviors_Desc" rows="2" ></textarea>
															</div>
													  
													 
													 </div>
													 </div>
									
										</div>
									</div>
								 </div>
								  <div class="disabled panel-heading">
											التشخيص
											</div>
                                <div class="disabled " id="tab3">
                                    <div class="disabled panel panel-default">
									  <div class="disabled panel-heading">
										  توضيح مرضي مفصل لكل شكوى تخص المريض
										</div>
										
										 <div class="disabled panel-body">
											<div class="disabled row">
											   
												 <div class="disabled form-group">
													<textarea class="disabled form-control" name="ind_Detailed_Diagnoses" id="ind_Detailed_Diagnoses" rows="2" ></textarea>
												</div>
												  
												 
											</div>
										</div>
								
									</div>
									<div class="disabled row">
										<div class="disabled col-xs-12 col-md-6 col-lg-6">
											<div class="disabled panel panel-default">
											  <div class="disabled panel-heading">
												  تصنيف حدة الاعراض - النفسة والسيكيولوجية - في الجلسة الاولى
												</div>
												
												 <div class="disabled panel-body">
													<div class="disabled row">
													   
														<div class="disabled form-group" style="direction: ltr;">
															
															<input type="text" class="disabled form-control" name="ind_Behavior_Degree" id="ind_Behavior_Degree" rows="3" ></input>
														</div>
														  
														 
													</div>
												</div>
										
											</div>
										
										</div>
										<div class="disabled col-xs-12 col-md-6 col-lg-6">
											<div class="disabled panel panel-default">
											  <div class="disabled panel-heading">
												  حدد اهم شكاوي/مشاكل/اعراض المريض - ثلاثة كحد اقصى
												</div>
												
												 <div class="disabled panel-body">
												 <div class="disabled row">
													   
														  <div class="disabled form-group">
																		 <textarea class="disabled form-control" name="ind_Important_Behaviors" id="ind_Important_Behaviors" rows="3" ></textarea>
																</div>
														  
														 
														 </div>
														 </div>
										
											</div>
										
										</div>
									</div>
									<div class="disabled row">
										<div class="disabled col-xs-12 col-md-6 col-lg-6">
											<div class="disabled panel panel-default">
											  <div class="disabled panel-heading">
												  تصنيف - إنخفاض الاداء - في الجلسة الاولى
												</div>
												
												 <div class="disabled panel-body">
													<div class="disabled row">
													   
														<div class="disabled form-group" style="direction: ltr;">
															
															<input type="text" class="disabled form-control" name="ind_Performance_Degree" id="ind_Performance_Degree" rows="2" ></input>
														</div>
														  
														 
													</div>
												</div>
										
											</div>
										
										</div>
										<div class="disabled col-xs-12 col-md-6 col-lg-6">
											<div class="disabled panel panel-default">
											  <div class="disabled panel-heading">
												  مدة هذه المشاكل/الشكاوي/الاعراض الرئيسية
												</div>
												
												 <div class="disabled panel-body">
												 <div class="disabled row">
													   
														  <div class="disabled form-group">
																		 <textarea class="disabled form-control" name="ind_Behaviors_Period" id="ind_Behaviors_Period" rows="2" ></textarea>
																</div>
														  
														 
														 </div>
														 </div>
										
											</div>
										
										</div>
									</div>
								</div>
								 <div class="disabled panel-heading">
											قائمة العوامل المساعدة
											</div>
											
										
                                           
								<div class="disabled " id="tab4">
                                    <div class="disabled panel panel-default">
									  <div class="disabled panel-heading">
										  عوامل اخرى
										</div>
										
										 <div class="disabled panel-body">
											<div class="disabled row">
											   
												 <div class="disabled form-group">
													<textarea class="disabled form-control" name="ind_Other_Factors" id="ind_Other_Factors" rows="2" ></textarea>
												</div>
												  
												 
											</div>
										</div>
								
									</div>
									<div class="disabled col-lg-12">
										<div class="disabled panel panel-default">
										  <div class="disabled panel-heading">
											  اهم العوامل المساعدة مرتبة بحسب الاهمية - ثلاثة كحد اقصى
											</div>
											
											 <div class="disabled panel-body">
											 <div class="disabled row">
												   
													  <div class="disabled form-group">
																	 <textarea class="disabled form-control" name="ind_Factors_Desc" id="ind_Factors_Desc" rows="2" ></textarea>
															</div>
													  
													 
													 </div>
													 </div>
									
										</div>
									</div>
								</div>
								
								 <div class="disabled panel-heading">
											فحص عام
											</div>
								<div class="disabled " id="tab5">
									<div class="disabled row">
										<div class="disabled col-xs-6 col-md-3 col-lg-3">
											<div class="disabled panel panel-default">
											  <div class="disabled panel-heading">
												  خطر الانتحار
												</div>
												
												 <div class="disabled panel-body">
													<div class="disabled row">
													    <table class="disabled table table-striped">
										
														  <tbody>
															   <tr>
																  <td> <input type="checkbox" name="rdbSuicide" id="rdbSuicide" value="1"></td>
																  <td>نعم</td>
															 </tr>
														  </tbody>
														</table> 
													</div>
												</div>
										
											</div>
										
										</div>
										<div class="disabled col-xs-6 col-md-3 col-lg-3">
											<div class="disabled panel panel-default">
											  <div class="disabled panel-heading">
												  خطر العنف
												</div>
												
												<div class="disabled panel-body">
													<div class="disabled row">
													   
														<div class="disabled form-group">
															<table class="disabled table table-striped">
											
																<tbody>
																	<tr>
																	  <td> <input type="checkbox" name="rdbViolence" id="rdbViolence" value="1"></td>
																	  <td>نعم</td>
																	</tr>
																</tbody>
															</table> 
														</div>
													</div>
												</div>
										
											</div>
										
										</div>
										<div class="disabled col-xs-6 col-md-3 col-lg-3">
											<div class="disabled panel panel-default">
											  <div class="disabled panel-heading">
												  التعاطي/الادمان
												</div>
												
												 <div class="disabled panel-body">
													<div class="disabled row">
													   
														<div class="disabled form-group">
															<table class="disabled table table-striped">
											
																<tbody>
																	<tr>
																	  <td> <input type="checkbox" name="rdbAddiction" id="rdbAddiction" value="1"></td>
																	  <td>نعم</td>
																	</tr>
																</tbody>
															</table> 
														</div>
													</div>
												</div>
										
											</div>
										
										</div>
										<div class="disabled col-xs-6 col-md-3 col-lg-3">
											<div class="disabled panel panel-default">
											  <div class="disabled panel-heading">
												  مشاكل طبية - إن وجدت
												</div>
												
												 <div class="disabled panel-body">
												 <div class="disabled row">
													   
														  <div class="disabled form-group">
																<textarea class="disabled form-control" name="ind_Medical_Problems" id="ind_Medical_Problems" rows="2" ></textarea>
															</div>
														  
														 
														 </div>
														 </div>
										
											</div>
										
										</div>
									</div>
									<div class="disabled row">
										<div class="disabled col-xs-12 col-md-6 col-lg-6">
											<div class="disabled panel panel-default">
											  <div class="disabled panel-heading">
												  تقييم القدرات المعرفية
												</div>
												
												 <div class="disabled panel-body">
													<div class="disabled row">
													   
														<div class="disabled form-group" style="direction: ltr;">
															
															<input type="text" class="disabled form-control" name="ind_Knowledge_Assessment" id="ind_Knowledge_Assessment" rows="2" ></input>
														</div>
														  
														 
													</div>
												</div>
										
											</div>
										
										</div>
										<div class="disabled col-xs-12 col-md-6 col-lg-6">
											<div class="disabled panel panel-default">
											  <div class="disabled panel-heading">
												  العقاقير النفسية - إن وجدت
												</div>
												
												 <div class="disabled panel-body">
												 <div class="disabled row">
													   
														  <div class="disabled form-group">
																		 <textarea class="disabled form-control" name="ind_Psych_Drugs" id="ind_Psych_Drugs" rows="1" ></textarea>
																</div>
														  
														 
														 </div>
														 </div>
										
											</div>
										
										</div>
									</div>
									<div class="disabled panel panel-default">
											  <div class="disabled panel-heading">
												  ملاحظات - لغة الجسد،المظهر،النظافة،الاتصال البصري، السلوك اليقظ،الحوار
												</div>
												
												 <div class="disabled panel-body">
													<div class="disabled row">
													   
														<div class="disabled form-group" style="direction: ltr;">
															
															<textarea class="disabled form-control" name="ind_Assessment_Note" id="ind_Assessment_Note" rows="3" ></textarea>
														</div>
														  
														 
													</div>
												</div>
										
											</div>
								</div>
								 <div class="disabled panel-heading">
											نوع الخدمة
											</div>
								<div class="disabled " id="tab6">
								
                                     <table class="disabled table table-striped" id="servicestable">
										
										  <tbody>
											   <tr>
										  <td> <input type="radio" name="rdbCaseAnalysisVictimState" id="rdbCaseAnalysisVictimState1" value="421"  checked></td>
										  <td>ضحية انتهاك جسدي</td>
										  <td><input type="radio" name="rdbCaseAnalysisVictimState" id="rdbCaseAnalysisVictimState2" value="412" ></td>
										      <td>ضحية انتهاك جنسي</td>
											    <td> <input type="radio" name="rdbCaseAnalysisVictimState" id="rdbCaseAnalysisVictimState3" value="413" ></td>
										      <td>ضحية إتجار</td>
											 </tr>
											   <tr>
										  <td> <input type="radio" name="rdbCaseAnalysisVictimState" id="rdbCaseAnalysisVictimState4" value="414" ></td>
										  <td>ضحية إهمال</td>
										  <td></td>
										      <td></td>
											    <td> </td>
										      <td></td>
											 </tr>
										  </tbody>
										  </table> 
										    
								</div>
								 <div class="disabled panel-heading">
											الإجراءات المقترحة
											</div>
								<div class="disabled " id="tab7">
                         <div class="disabled panel panel-default">
				      <div class="disabled panel-heading">
                          الإجراء المقترح
                        </div>
						
						 <div class="disabled panel-body">
						 <div class="disabled row">
							   
								  <div class="disabled form-group">
                                                 <textarea class="disabled form-control" name="ind_taken_actions" id="ind_taken_actions" rows="2" ></textarea>
                                        </div>
								  
								 
								 </div>
								 </div>
				
				          </div>
				        
							 
							      
							 
				   <div class="disabled col-lg-12">
				     <div class="disabled panel panel-default">
				      <div class="disabled panel-heading">
                         التوصيات
                        </div>
						
						 <div class="disabled panel-body">
						 <div class="disabled row">
							   
								  <div class="disabled form-group">
                                                 <textarea class="disabled form-control" name="ind_recommendations" id="ind_recommendations" rows="3" ></textarea>
                                        </div>
								  
								 
								 </div>
								 </div>
				
				          </div>
				         </div>
							  
							   
				   <div class="disabled col-lg-12">
				     <div class="disabled panel panel-default">
				      <div class="disabled panel-heading">
                         المقترحات
                        </div>
						
						 <div class="disabled panel-body">
						 <div class="disabled row">
							   
								  <div class="disabled form-group">
                                      <textarea name="ind_suggestions" id="ind_suggestions" class="disabled form-control" rows="3" ></textarea>
                                   </div>
								  
								 
								 </div>
								 </div>
				
				          </div>
				         </div>
						
						
					
								   </div>
                                
                               
                           
                            </div>
							</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
 
  <script src="js/vendor/jquery-1.12.4.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
<script src='GrdExp/js/bootstrap-table.js'></script>
<link rel="stylesheet" href="js/rangeSlider/dist/main.min.css">
<script src="js/rangeSlider/dist/jQuery.inputSliderRange.min.js"></script>

	<script>
		$( "#analysis-page" ).addClass( "active" );
		$( "#Interface" ).addClass( "active" );
	</script>
	
 <script>
$(function(){
	
	$('#tab2').prepend(jsTab2);
	$('#tab3').append(jsTab3);
	$('#tab4').prepend(jsTab4);
	//$('#behavioronth').html(jsAnotherData);
	$('#servicestable').html(jsServiceData);
	$('#CaseId').val(CaseID);
	$('#btnFriendlyEnvironmentReferral').on('click',function(e){
		
		  $.post('AjaxFiles/AjaxRetrieveFrnEnvData.php',{CaseId:CaseID},function(r){
			      r=JSON.parse(r);
			 console.log(r);
			
			  $('#AssignedSrvGvr_id').html(rsp);
			   if(r.length>1)
			   {$('#AssignedSrvGvr_id').val(r[0].Service_giver_id),$('#SrvStrDate').val(setDefaultDate(r[0].Start_date)),$('#SrvEndDate').val(setDefaultDate(r[0].End_date));}
		       else
			   {$('#SrvStrDate').val(setDefaultDate('')),$('#SrvEndDate').val(setDefaultDate(''));}
		      $('#FREnvReferralFormModal').modal('show');
		   });
		 
		
   	});
	
	$('#frm_FrnEnv').on('submit',function(e){
		
		e.preventDefault();
		$.post('AjaxFiles/AjaxAssign2FrnEnv.php',$('#frm_FrnEnv').serializeArray(),function(r){
					  $('#FREnvReferralFormModal').modal('hide');
			  });
	
	});
	
	var v=$("#tblCurrentChildData").bootstrapTable('destroy');
		v.bootstrapTable({ data:JsChildData});
$('#frm_child_analysis').on('submit', function (e) {
	       $('#ind_Diagnose_Date').val(setDefaultDate($('#ind_Diagnose_Date').val())) ;
			var dataS=$('#frm_child_analysis').serializeArray();
			dataS.push({'name':'ChildCaseId','value':'<?php echo isset($_REQUEST["ChildCaseID"])?$_REQUEST["ChildCaseID"]:$_REQUEST["Case_No"]; ?>'});
			//console.log(dataS);
			let CheckedActivity=[];
			let UnCheckedActivity=[];
			$('.ActivityRow').each(function(k,i){
				 let currenrRow=$(this);
				 if($('.checkAtivity').eq(k).is(":checked") )
					CheckedActivity.push($('input[name="ActivityId"]').eq(k).val());
				  else 
					UnCheckedActivity.push($('input[name="ActivityId"]').eq(k).val());
			 
		   });
		   
		   
		   
		   CheckedBehavior=[];
			let UnCheckedBehavior=[];
			$('.BehaviorRow').each(function(k,i){
				 let currenrRow=$(this);
				 if($('.checkBehavior').eq(k).is(":checked") )
					CheckedBehavior.push($('input[name="BehaviorId"]').eq(k).val());
				  else 
					UnCheckedBehavior.push($('input[name="BehaviorId"]').eq(k).val());
			 
		   });
		  
		   
			
			e.preventDefault();
			       console.log('Chk'+UnCheckedBehavior);       
			$.post('AjaxFiles/AjaxSaveInitialDiagnose.php',dataS,function(r){
				if(r>0)
				{$('#Diagnose_id').val(r);
			      $.post('AjaxFiles/AjaxSaveInitialDiagnoseSrvBhv.php',{diagnoseId:r,checkedAct:CheckedActivity,unCheckedAct:UnCheckedActivity,checkedBhv:CheckedBehavior,uncheckedBhv:UnCheckedBehavior},function(r2){
					
					 if(parseInt(r2)>0)
						  	mkNoti('تم', 'تم الحفظ بنجاح! ', { status: 'success' });
						else
							mkNoti('خطأ', 'الرجاء التأكد من صحة البيانات! ', { status: 'danger' });
				  });
			
				}
				//i must set the IsAnalysisExist to true to tell the database that this analysis is exist 
				//( to prevent the duplications of records if the user tried to save the form without refreshing the page)
				//if(r != '0')
				//$("#IsAnalysisExist").val('1');
			});
		});
	$('#btnPrint').on('click',function(e){
		 window.open('analysis_data_print.php?ChildCaseId=' + '<?php //echo isset($param["ChildCaseID"])?$param["ChildCaseID"]:$param["Case_No"]; ?>' , '_blank');	
	});
	
});
</script>
<script>
var input1 = 5;
var input2 = 5;
$(function(){
	if(JsChildData != '1'){
		$.each(JsChildData,function(k,i)
        {	$("#Diagnose_id").val(i.Diagnose_id);
			$("#ind_main_complaint").val(i.Main_complaint);
			$("#ind_reasons").val(i.Reasons);
			$("#ind_taken_actions").val(i.Taken_actions);
			$("#ind_recommendations").val(i.Recommendations);
			$("#ind_suggestions").val(i.Suggestions);
			
			$("#ind_other_Behaviors").val(i.other_Behaviors);
			$("#ind_Behaviors_Desc").val(i.Behaviors_Desc);
			$("#ind_Detailed_Diagnoses").val(i.Detailed_Diagnoses);
			$("#ind_Behavior_Degree").val(i.Behavior_Degree);
			$("#ind_Important_Behaviors").val(i.Important_Behaviors);
			$("#ind_Performance_Degree").val(i.Performance_Degree);
			$("#ind_Behaviors_Period").val(i.Behaviors_Period);
			$("#ind_Diagnose_Date").val(i.Diagnose_Date);
			$("#ind_Other_Factors").val(i.Other_Factors);
			$("#ind_Factors_Desc").val(i.Factors_Desc);
			if(i.Suicide == 1)
				$("#rdbSuicide").prop( "checked", true );
			if(i.Violence == 1)
				$("#rdbViolence").prop( "checked", true );
			if(i.Addiction == 1)
				$("#rdbAddiction").prop( "checked", true );
			$("#ind_Medical_Problems").val(i.Medical_Problems);
			$("#ind_Knowledge_Assessment").val(i.Knowledge_Assessment);
			$("#ind_Psych_Drugs").val(i.Psych_Drugs);
			$("#ind_Assessment_Note").val(i.Assessment_Note);
	     });
	}
	
});
var setDefaultDate=function(param)
{
	if(!param)
		param=new Date().toISOString().slice(0, 10);
	return param;
}


	$(document).ready(function(e){
        $('#ind_Behavior_Degree').inputSliderRange({
            "min": 1,
            "max": 10,
            "start": $('#ind_Behavior_Degree').val(),
            "grid": true,
             "gridCompression": true,
            
        });
		$('#ind_Performance_Degree').inputSliderRange({
            "min": 1,
            "max": 10,
            "start": $('#ind_Performance_Degree').val(),
            "grid": true,
             "gridCompression": true,
            
        });
		$('.disabled').attr('disabled',true);
		$("input[type='checkbox']").attr('disabled',true);
	});
	

</script>