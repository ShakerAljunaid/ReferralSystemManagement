<?php 
require_once("header-links.php");
//require('AjaxFiles/AjaxRetriveCaseAnalysis.php');
if(isset($_REQUEST["Case_No"])){
		$sql = 'SELECT childId,ChildFullName,Gender,CareGiverFullName,CareGiverPhoneNo,ChildAddress,caseId,ParentState,Specialist_id,
				CASE WHEN ini.ID IS NULL THEN 0 ELSE ini.ID END AS Diagnose_id, Main_complaint,Reasons,Taken_actions,Recommendations,Suggestions
				FROM childgridviewdata as chi LEFT OUTER JOIN initialdiagnose AS ini ON chi.caseId = ini.Case_id
				WHERE chi.caseId ='.$_REQUEST["Case_No"]; 
		 $ChildData = $pdo->query($sql)->fetchAll();
		 echo '<script> var JsChildData='.json_encode($ChildData).';var ChildID='.$_REQUEST["Case_No"].'</script>';
	
$CDiagnose_id = current($ChildData)["Diagnose_id"];
$sql =  "SELECT mlist.ID, mlist.Title, mlist.Parent_id, CASE WHEN bhvr.ID is NULL THEN '' ELSE 'checked' END AS chk FROM manylist AS mlist
LEFT OUTER JOIN initialdiagnose_behavior as bhvr ON bhvr.Intial_diagnose_id = ".$CDiagnose_id." AND mlist.ID = bhvr.Behavior_id
where mlist.List_type_id = 19;";
$ManyListData=$pdo->query($sql)->fetchAll();
$AnotherData="<tbody><tr>";
$PhysioData="<tbody><tr>";
foreach ($ManyListData as $md)
{
	if($md['Parent_id'] == 423)
		$PhysioData.="<td class='BehaviorRow'><input type='checkbox' class='i-checks checkBehavior' name='checkBehavior' ".$md['chk']."> <input type='hidden' id='BehaviorId' name='BehaviorId' value='".$md['ID']."'></td><td> ".$md['Title']."</td>";
	else
		$AnotherData.="<td class='BehaviorRow'><input type='checkbox' class='i-checks checkBehavior' name='checkBehavior' ".$md['chk']."><input type='hidden' id='BehaviorId' name='BehaviorId' value='".$md['ID']."'></td><td> ".$md['Title']."</td>"; 
	
}
$sql =  "SELECT s.ID,Title, CASE WHEN bhvr.ID is NULL THEN '' ELSE 'checked' END AS chk
FROM service AS s LEFT OUTER JOIN initialdiagnose_suggestedservices as bhvr ON bhvr.Intial_diagnose_id = ".$CDiagnose_id." AND s.ID = bhvr.Service_id
WHERE s.Service_cat = 381;";
$ManyListData=$pdo->query($sql)->fetchAll();
$ServiceData="<tbody><tr>";
foreach ($ManyListData as $md)
{
	$ServiceData.="<td class='ServiceRow'><input type='checkbox' class='i-checks checkService' name='checkService' ".$md['chk']."> <input type='hidden' id='ServiceId' name='ServiceId' value='".$md['ID']."'></td><td> ".$md['Title']."</td>";
}
$PhysioData.='</tr></tbody>';
$AnotherData.='</tr></tbody>';
$ServiceData.='</tr></tbody>';
echo '<script>var sfdff = '.$CDiagnose_id.';var jsPhysioData="'.$PhysioData.'";var jsAnotherData="'.$AnotherData.'";var jsServiceData="'.$ServiceData.'";</script>'; 
}
?>
<div class="breadcomb-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 col-md-12 col-sm-12 col-xs-12 ">
					<div class="breadcomb-list">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="breadcomb-wp">
									<div class="breadcomb-icon">
										<i class="notika-icon notika-support"></i>
									</div>
									<div class="breadcomb-ctn ">
										<h2 id="CurrentScreen">التشخيص المبدئي للطفل</h2>
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
 	 <div class="wizard-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="wizard-wrap-int">
                        <div class="wizard-hd">
                            <h2>بيانات الطفل</h2>
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
                        <div id="rootwizard">
                            <div class="navbar">
                                <div class="navbar-inner">
                                    <div class="container-pro wizard-cts-st">
                                        <ul>
                                            <li><a href="#tab1" data-toggle="tab">الشكوى والاسباب</a></li>
                                            <li><a href="#tab2" data-toggle="tab">التشخيص المبدئي</a></li>
                                            <li><a href="#tab3" data-toggle="tab">نوع الخدمة</a></li>
                                            <li><a href="#tab4" data-toggle="tab">الإجراءات المقترحة</a></li>
                                           
                                        </ul>
                                    </div>
                                </div>
                            </div>
								 <form role="form" id="frm_child_analysis"  method="POST"  data-toggle="validator" role="form">
				                    <input type="hidden" id="Diagnose_id" name="Diagnose_id" value="0" />
                            <div class="tab-content">
                               
                                <div class="tab-pane wizard-ctn" id="tab1">
									<div class="panel panel-default">
									  <div class="panel-heading">
										  الشكوى الرئيسية
										</div>
										
										 <div class="panel-body">
											<div class="row">
											   
												 <div class="form-group">
													<textarea class="form-control" name="ind_main_complaint" id="ind_main_complaint" rows="2" required></textarea>
												</div>
												  
												 
											</div>
										</div>
								
									</div>
									<div class="col-lg-12">
										<div class="panel panel-default">
										  <div class="panel-heading">
											  الاسباب
											</div>
											
											 <div class="panel-body">
											 <div class="row">
												   
													  <div class="form-group">
																	 <textarea class="form-control" name="ind_reasons" id="ind_reasons" rows="3" required></textarea>
															</div>
													  
													 
													 </div>
													 </div>
									
										</div>
									</div>
								</div>
								 <div class="tab-pane wizard-ctn" id="tab2">
									<div class="form-group">
                                            <label>التشخيص النفسي:</label>
                                            
										
										
                                          <div class="">
										  <table class="table table-striped" id="behaviorphys">
										
										  <tbody>
										  <tr>
										  
											    <!--<td> <input type="radio" name="rdbtnCurrentIssue" id="rdbtnCurrentIssue9" value="423" ></td>-->
										      <td></td>
											 </tr>
											 
											 
										  </tbody>
										  </table>
										   
										  </div>
                                           
                                    </div>
									<div class="form-group">
                                            <label>التشخيص السلوكي:</label>
                                            
										
										
                                          <div class="">
										  <table class="table table-striped" id="behavioronth">
										
										  <tbody>
										  <tr>
										  
											    <!--<td> <input type="radio" name="rdbtnCurrentIssue" id="rdbtnCurrentIssue9" value="423" ></td>-->
										      <td></td>
											 </tr>
											 
											 
										  </tbody>
										  </table>
										   
										  </div>
                                           
                                    </div>
								 </div>
                                <div class="tab-pane wizard-ctn" id="tab3">
                                     <table class="table table-striped" id="servicestable">
										
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
                                <div class="tab-pane wizard-ctn" id="tab4">
                                    <div class="panel panel-default">
				      <div class="panel-heading">
                          الإجراء المقترح
                        </div>
						
						 <div class="panel-body">
						 <div class="row">
							   
								  <div class="form-group">
                                                 <textarea class="form-control" name="ind_taken_actions" id="ind_taken_actions" rows="2" required></textarea>
                                        </div>
								  
								 
								 </div>
								 </div>
				
				          </div>
				        
							 
							      
							 
				   <div class="col-lg-12">
				     <div class="panel panel-default">
				      <div class="panel-heading">
                         التوصيات
                        </div>
						
						 <div class="panel-body">
						 <div class="row">
							   
								  <div class="form-group">
                                                 <textarea class="form-control" name="ind_recommendations" id="ind_recommendations" rows="3" required></textarea>
                                        </div>
								  
								 
								 </div>
								 </div>
				
				          </div>
				         </div>
							  
							   
				   <div class="col-lg-12">
				     <div class="panel panel-default">
				      <div class="panel-heading">
                         المقترحات
                        </div>
						
						 <div class="panel-body">
						 <div class="row">
							   
								  <div class="form-group">
                                      <textarea name="ind_suggestions" id="ind_suggestions" class="form-control" rows="3" required></textarea>
                                   </div>
								  
								 
								 </div>
								 </div>
				
				          </div>
				         </div>
						 <div class="vw-ml-action-ls text-right mg-t-20">
                            <div class="btn-group ib-btn-gp active-hook nk-email-inbox">
                                <button type="submit" class="btn btn-default btn-sm waves-effect"><i class="notika-icon notika-form"></i> حفظ</button>
								<button class="btn btn-default btn-sm waves-effect" id="btnInternalReferral" ><i class="notika-icon notika-left-arrow"></i> إحالة داخلية</button>
                                <button class="btn btn-default btn-sm waves-effect" id="btnPrint"><i class="notika-icon notika-down-arrow"></i> طباعة</button>
                                <button class="btn btn-default btn-sm waves-effect hidden"><i class="notika-icon notika-trash"></i> تهيئة</button>
                            </div>
                        </div>
						
					
								   </div>
                                
                                <div class="wizard-action-pro">
                                    <ul class="wizard-nav-ac">
                                        <li><a class="button-first a-prevent" href="#"><i class="notika-icon notika-more-button"></i></a></li>
                                        <li><a class="button-previous a-prevent" href="#"><i class="notika-icon notika-back"></i></a></li>
                                        <li><a class="button-next a-prevent" href="#"><i class="notika-icon notika-next-pro"></i></a></li>
                                        <li><a class="button-last a-prevent" href="#"><i class="notika-icon notika-more-button"></i></a></li>
                                    </ul>
                                </div>
									
                           
                            </div>
							</form>
					
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
    
<!--  wizard JS
		============================================ -->
    <script src="js/wizard/jquery.bootstrap.wizard.min.js"></script>
    <script src="js/wizard/wizard-active.js"></script>
<?php require_once("footer-links.php");  ?>
	<script>
		$( "#analysis-page" ).addClass( "active" );
		$( "#Interface" ).addClass( "active" );
	</script>
 <script>
$(function(){
	$('#behaviorphys').html(jsPhysioData);
	$('#behavioronth').html(jsAnotherData);
	$('#servicestable').html(jsServiceData);
	var v=$("#tblCurrentChildData").bootstrapTable('destroy');
		v.bootstrapTable({ data:JsChildData});
$('#frm_child_analysis').on('submit', function (e) {
			var dataS=$('#frm_child_analysis').serializeArray();
			dataS.push({'name':'ChildCaseId','value':'<?php echo isset($_REQUEST["ChildCaseID"])?$_REQUEST["ChildCaseID"]:$_REQUEST["Case_No"]; ?>'});
			let CheckedService=[];
			let UnCheckedService=[];
			$('.ServiceRow').each(function(k,i){
				 let currenrRow=$(this);
				 if($('.checkService').eq(k).is(":checked") )
					CheckedService.push($('input[name="ServiceId"]').eq(k).val());
				  else 
					UnCheckedService.push($('input[name="ServiceId"]').eq(k).val());
			 
		   });
		   dataS.push({'name':'CheckedService','value':CheckedService});
		   dataS.push({'name':'UnCheckedService','value':UnCheckedService});
		   
		   let CheckedBehavior=[];
			let UnCheckedBehavior=[];
			$('.BehaviorRow').each(function(k,i){
				 let currenrRow=$(this);
				 if($('.checkBehavior').eq(k).is(":checked") )
					CheckedBehavior.push($('input[name="BehaviorId"]').eq(k).val());
				  else 
					UnCheckedBehavior.push($('input[name="BehaviorId"]').eq(k).val());
			 
		   });
		   dataS.push({'name':'CheckedBehavior','value':CheckedBehavior});
		   dataS.push({'name':'UnCheckedBehavior','value':UnCheckedBehavior});
		   
			   console.log(dataS);
			e.preventDefault();
			$.post('AjaxFiles/AjaxSaveInitialDiagnose.php',dataS,function(r){
				alert(r);
				$('#Diagnose_id').val(r);
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
$(function(){
	if(JsChildData != '1'){
		$.each(JsChildData,function(k,i)
        {
			$("#Diagnose_id").val(i.Diagnose_id);
			$("#ind_main_complaint").val(i.Main_complaint);
			$("#ind_reasons").val(i.Reasons);
			$("#ind_taken_actions").val(i.Taken_actions);
			$("#ind_recommendations").val(i.Recommendations);
			$("#ind_suggestions").val(i.Suggestions);
	     });
	}
	
});

</script>