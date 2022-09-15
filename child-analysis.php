<?php 
require_once("header-links.php");
//require('AjaxFiles/AjaxAssignCaseSpecist.php');
require('AjaxFiles/AjaxRetriveCaseAnalysis.php');
if(isset($_REQUEST["Case_No"]) || isset($_REQUEST["ChildCaseID"]) ){
  $ChildCaseID=	isset($_REQUEST["ChildCaseID"])? $_REQUEST["ChildCaseID"]:$_REQUEST["Case_No"];
		$sql = "SELECT childId,ChildFullName,Gender,Age,childSource,CareGiverFullName,CareGiverPhoneNo,ChildAddress,caseId,ParentState,Specialist_id,
				CASE WHEN cca.ID IS NULL THEN 0 ELSE cca.ID END AS Analysis_id,DisplacedState,Diagonse_state,Iom_analysis_state,
				cca.Disability_state,cca.Disability_id,cca.Protection_issues
				FROM childgridviewdata as chi LEFT OUTER JOIN childcaseanalysis AS cca ON chi.caseId = cca.Case_id
				WHERE chi.caseId =".$ChildCaseID; 
		
		 $ChildData = $pdo->query($sql)->fetchAll();
		 echo '<script> var JsChildData='.json_encode($ChildData).';var ChildID='.$ChildCaseID.'</script>';

    
$Analysis_id = current($ChildData)["Analysis_id"];
$sql='select  ID ,Name  from externalagency; ';
$AgencyData=$pdo->query($sql)->fetchAll();
$AgencyString='';
foreach($AgencyData as $AD)
{$AgencyString .='<option value='.$AD['ID'].' >'.$AD['Name'].'</option>'; }
$sql='select * from agencyreferralpersonview ';
$AgencyPeople=$pdo->query($sql)->fetchAll();
echo '<script>

var jsAgencyData="'.$AgencyString.'";var jsAgencyPeopleData='.json_encode($AgencyPeople).';
var setPeopleOfAgency=function(AgencyId)
{ let people="";
  $.each(jsAgencyPeopleData,function(k,i) {if(i.Agency_id==AgencyId ) people +="<option   value="+i.PersonId+" >"+i.FullName+"</option>"; });
	return people;
};
</script>';

$sql =  "SELECT s.ID,Title,s.Service_cat, CASE WHEN sasr.ID is NULL THEN '' ELSE 'checked' END AS chk
FROM service AS s LEFT OUTER JOIN case_analysis_suggested_services as sasr ON sasr.Analysis_id = ".$Analysis_id." AND s.ID = sasr.Service_id
";
$ServiceData=$pdo->query($sql)->fetchAll();
$sql =  "SELECT ID,Title, List_type_id  FROM manylist where List_type_id=27";
$ManyListData=$pdo->query($sql)->fetchAll();
$TimedServiceDataString="<tbody><tr>";
$ValuedServiceString="<tbody><tr>";
$EchoServiceString="<tbody><tr>";
$DisabilitiesString="<tbody><tr>";
foreach ($ServiceData as $md)
{	if($md['Service_cat']==381)
        $TimedServiceDataString.="<td class='ServiceRow'><input type='checkbox'   class='i-checks checkService cntState' name='checkService' ".$md['chk']."> <input type='hidden' id='ServiceId' name='ServiceId' value='".$md['ID']."'></td><td> ".$md['Title']."</td>";
    else if($md['Service_cat']==380)
		$ValuedServiceString .="<td class='ServiceRow'><input type='checkbox' class='i-checks checkService cntState' name='checkService' ".$md['chk']."> <input type='hidden' id='ServiceId' name='ServiceId' value='".$md['ID']."'></td><td> ".$md['Title']."</td>";
    else
		$EchoServiceString .="<td class='ServiceRow'><input type='checkbox' class='i-checks checkService cntState' name='checkService' ".$md['chk']."> <input type='hidden' id='ServiceId' name='ServiceId' value='".$md['ID']."'></td><td> ".$md['Title']."</td>";
} 
foreach ($ManyListData as $mn)
{
	if($mn['List_type_id']==27)
        $DisabilitiesString.="<td class='DisabilityRow'> <input type='radio' name='CaseDisabilityId'  value=".$mn['ID']." ><span  class='checkSpan'>".$mn['Title']."</span></td>";	
} 


$TimedServiceDataString.='</tr></tbody>';
$ValuedServiceString .= '</tr></tbody>';
$EchoServiceString .= '</tr></tbody>';
$DisabilitiesString .="</tr></tbody>";
echo '<script>var CaseAnalysisId = '.$Analysis_id.';var jsTimedServiceData="'.$TimedServiceDataString.'";var jsValuedServiceData="'.$ValuedServiceString.'";var jsEchonomicServiceData="'.$EchoServiceString.'"; var JSDisabilitiesString="'.$DisabilitiesString.'";</script>'; 
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
														 <th  data-field="Age" >العمر</th>
														  <th  data-field="DisplacedState" data-filter-control="select" data-sortable="true">؟نازح</th>
													<th  data-field="CareGiverFullName" >اسم المُعتني</th>
													<th  data-field="CareGiverPhoneNo" >رقم الهاتف</th>
													<th  data-field="ChildAddress" > العنوان</th>
													<th  data-field="childSource" > المصدر</th>
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
                                            <li><a href="#tab1" data-toggle="tab">حالة المعيشة</a></li>
                                            <li><a href="#tab2" data-toggle="tab">المشكلة الحالية</a></li>
                                            <li><a href="#tab3" data-toggle="tab">حالة الطفل</a></li>
                                            <li><a href="#tab4" data-toggle="tab">الإجراءات المقترحة</a></li>
                                           
                                        </ul>
                                    </div>
                                </div>
                            </div>
								 <form role="form" id="frm_child_analysis"  method="POST"  data-toggle="validator" role="form">
				                    <input type="hidden" id="IsAnalysisExist" name="IsAnalysisExist" value="0" />
                            <div class="tab-content">
                               
                                <div class="tab-pane wizard-ctn" id="tab1">
                                    <table class="table table-striped ">
										
										  <tbody>
										  <tr>
										  <td>  <input type="radio" class="cntState" name="rdbCaseAnalysisLivingStatus" id="rdbCaseAnalysisLivingStatus1" value="399" checked></td>
										  <td> يعيش مع والدية</td>
										  <td> <input type="radio" class="cntState" name="rdbCaseAnalysisLivingStatus" id="rdbCaseAnalysisLivingStatus2" value="400" ></td>
										      <td>يعيش مع امه</td>
											    <td> <input type="radio" class="cntState" name="rdbCaseAnalysisLivingStatus" id="rdbCaseAnalysisLivingStatus3" value="401" ></td>
										      <td>يعيش مع ابوه</td>
											 </tr>
											  <tr>
										  <td> <input type="radio" class="cntState" name="rdbCaseAnalysisLivingStatus" id="rdbCaseAnalysisLivingStatus4" value="402" ></td>
										  <td> يعيش مع اخ بالغ</td>
										  <td><input type="radio"  class="cntState" name="rdbCaseAnalysisLivingStatus" id="rdbCaseAnalysisLivingStatus5" value="403" ></td>
										      <td>يعيش مع قريب من الأسرة</td>
											    <td> <input type="radio" class="cntState" name="rdbCaseAnalysisLivingStatus" id="rdbCaseAnalysisLivingStatus6" value="404" ></td>
										      <td>يعيش مع شخص بالغ من خارج الأسرة</td>
											 </tr>
											 
											  <tr>
										  <td> <input type="radio" class="cntState" name="rdbCaseAnalysisLivingStatus" id="rdbCaseAnalysisLivingStatus7" value="405" ></td>
										  <td> يعيش في مؤسسة (بعيد عن الأسرة)</td>
										  <td> <input type="radio" class="cntState" name="rdbCaseAnalysisLivingStatus" id="rdbCaseAnalysisLivingStatus8" value="406" ></td>
										      <td>يعيش في مدرسة</td>
											    <td> <input type="radio" class="cntState" name="rdbCaseAnalysisLivingStatus" id="rdbCaseAnalysisLivingStatus9" value="407" ></td>
										      <td>يعيش في الشارع</td>
											 </tr>
											   <tr>
										  <td> <input type="radio" class="cntState" name="rdbCaseAnalysisLivingStatus" id="rdbCaseAnalysisLivingStatus10" value="408" ></td>
										  <td> يعيش مع الوالدين او احدهما في الشارع</td>
										  <td> <input type="radio" class="cntState" name="rdbCaseAnalysisLivingStatus" id="rdbCaseAnalysisLivingStatus11" value="409" ></td>
										      <td>يتيم يعش مع اسرة اخرى</td>
											    <td> <input type="radio" class="cntState" name="rdbCaseAnalysisLivingStatus" id="rdbCaseAnalysisLivingStatus12" value="410" ></td>
										      <td>يتيم يعيش في المدرسة</td>
											 </tr>
											 </tbody>
										  </table>          </div>
								 <div class="tab-pane wizard-ctn" id="tab2">
                                  <div class="form-group">
                                            <label>المشكلة الحالية:</label>
                                            
										
										
                                          <div class="">
										  <table class="table table-striped ">
										
										  <tbody>
										  <tr>
										  <td>  <input type="radio" class="cntState" name="rdbtnCurrentIssue" id="rdbtnCurrentIssue1" value="415" checked></td>
										  <td> معانة الطفل</td>
										  <td> <input type="radio" class="cntState" name="rdbtnCurrentIssue" id="rdbtnCurrentIssue2" value="416" ></td>
										      <td>طفل معاق</td>
											    <td> <input class="cntState" type="radio" name="rdbtnCurrentIssue" id="rdbtnCurrentIssue3" value="417" ></td>
										      <td>المُعتني بالطفل يعني من إعاقة او مرض دائم</td>
											 </tr>
											  <tr>
										  <td> <input type="radio" class="cntState" name="rdbtnCurrentIssue" id="rdbtnCurrentIssue4" value="418" ></td>
										  <td> زواج مبكر</td>
										  <td><input type="radio" class="cntState" name="rdbtnCurrentIssue" id="rdbtnCurrentIssue5" value="419" ></td>
										      <td>مخالف القانون</td>
											    <td> <input type="radio" name="rdbtnCurrentIssue" id="rdbtnCurrentIssue6" value="420" ></td>
										      <td>مدمن مخدرات او مواد اخرى</td>
											 </tr>
											 
											  <tr>
										  <td> <input type="radio" class="cntState" name="rdbtnCurrentIssue" id="rdbtnCurrentIssue7" value="421" ></td>
										  <td> ضحية لإستغلال جنسي تجاري</td>
										  <td> <input type="radio" class="cntState" name="rdbtnCurrentIssue" id="rdbtnCurrentIssue8" value="422" ></td>
										      <td>تاريخ الميلاد غير مسجل</td>
											    <!--<td> <input type="radio" name="rdbtnCurrentIssue" id="rdbtnCurrentIssue9" value="423" ></td>-->
										      <td> <input type="radio"  class="cntState" name="rdbtnCurrentIssue" id="rdbtnCurrentIssue9" value="525" ></td>
										  <td> الإساءة</td>
										    <td> <input type="radio" class="cntState" name="rdbtnCurrentIssue" id="rdbtnCurrentIssue10" value="526" ></td>
										  <td> الحرمان من الموارد</td>
											 </tr>
											 
											 
										  </tbody>
										  </table>
										   <label>مشاكل اخرى:</label>
										  <div class="form-group">
                                                 <textarea class="form-control cntState" name="CaseAnalysisOtherIssues" id="CaseAnalysisOtherIssues" rows="3" ></textarea>
                                        </div>
										 <label>مشاكل الحماية:</label>
										  <div class="form-group">
                                                 <textarea class="form-control cntState" name="CaseProtecionIssues" id="CaseProtecionIssues" rows="3" ></textarea>
                                        </div>
										  </div>
                                          
										 
                                        </div>
								 </div>
                                <div class="tab-pane wizard-ctn" id="tab3">
                                     <table class="table table-striped ">
										
										  <tbody>
											   <tr>
										  <td> <input type="radio" class="cntState" name="rdbCaseAnalysisVictimState" id="rdbCaseAnalysisVictimState1" value="421"  checked></td>
										  <td>ضحية انتهاك جسدي</td>
										  <td><input type="radio" class="cntState" name="rdbCaseAnalysisVictimState" id="rdbCaseAnalysisVictimState2" value="412" ></td>
										      <td>ضحية انتهاك جنسي</td>
											    <td> <input type="radio" class="cntState" name="rdbCaseAnalysisVictimState" id="rdbCaseAnalysisVictimState3" value="413" ></td>
										      <td>ضحية إتجار</td>
											 </tr>
											   <tr>
										  <td> <input type="radio" class="cntState" name="rdbCaseAnalysisVictimState" id="rdbCaseAnalysisVictimState4" value="414" ></td>
										  <td>ضحية إهمال</td>
										  <td></td>
										      <td></td>
											    <td> </td>
										      <td></td>
											 </tr>
										  </tbody>
										  </table> 
										
										 <div class="panel panel-default">
				      <div class="panel-heading">
                           الإعاقة :
                        </div>
						
						 <div class="panel-body">
						 <div class="row">
							   <span  class='checkSpan'><h4> <input type='checkbox' class='i-checks'  id="CaseDisabilityState" >هل يعاني الطفل من إعاقة؟</h4></span>
								
								 <div class="form-group DisabilitiesDiv">
								 
								    <center><strong>نوع الإعاقة:</strong></center>
                                            <table class="table table-striped" id="Disabilitiestable">
										
									
										  </table>
								 
                                </div>
								  
								 
								 </div>
								 </div>
				
				          </div>
					
										  
										    <div class="panel panel-default">
				      <div class="panel-heading">
                           سبب  طلب الإحالة
                        </div>
						
						 <div class="panel-body">
						 <div class="row">
							   
								  <div class="form-group">
                                                 <textarea class="form-control cntState" rows="2" id="CaseAnalysisCaseReason" name="CaseAnalysisCaseReason" required></textarea>
                                </div>
								  
								 
								 </div>
								 </div>
				
				          </div>
										  </div>
                                <div class="tab-pane wizard-ctn" id="tab4">
                                    <div class="panel panel-default">
				      <div class="panel-heading">
                          الإجراء المقترح من قبل مدير الإحالة
                        </div>
						
						 <div class="panel-body">
						 <div class="row">
							   
								  <div class="form-group">
                                                 <textarea class="form-control cntState" name="CaseAnalysisSuggestedPrcByReferralManager" id="CaseAnalysisSuggestedPrcByReferralManager" rows="2" required></textarea>
                                        </div>
								  
								 
								 </div>
								 </div>
				
				          </div>
				        
							 
							      
							
				   <div class="col-lg-12">
				     <div class="panel panel-default">
				      <div class="panel-heading">
                          الإجراء المقترح من قبل المختص النفسي
                        </div>
						
						 <div class="panel-body">
						 <div class="row">
							   
								  <div class="form-group">
                                                 <textarea class="form-control cntState" name="CaseAnalysisSuggestedPrcByPhsycoSpecialist" id="CaseAnalysisSuggestedPrcByPhsycoSpecialist" rows="3" required></textarea>
                                        </div>
								  
								 
								 </div>
								 </div>
				
				          </div>
				         </div>
							  
							   
				   <div class="col-lg-12">
				     <div class="panel panel-default">
				      <div class="panel-heading">
                         الخدمات المقترح تقديمها للحالة
                        </div>
						
						 <div class="panel-body">
						 <div class="row">
							   <div class="form-group">
                                            <label>دعم نفسي إجتماعي :</label>
                                            
										
										
                                          <div class="">
										  <table class="table table-striped" id="Timedservicestable">
										
									
										  </table>
										   
										  </div>
                                           
                                    </div>
									 <div class="form-group">
                                            <label>دعم نفسي اقتصادي :</label>
                                            
										
										
                                          <div class="">
										  <table class="table table-striped" id="Echnomicservicestable">
										
									
										  </table>
										   
										  </div>
                                           
                                    </div>
									<div class="form-group">
                                            <label>مساعدات طبية :</label>
                                                                                      <div class="">
										  <table class="table table-striped" id="Valuedservicestable">
										
										  </table>
										   
										  </div>
                                           
                                    </div>
								
								 
								 </div>
								 </div>
				
				          </div>
				         </div>
						 <div class="vw-ml-action-ls text-right mg-t-20">
                            <div class="btn-group ib-btn-gp active-hook nk-email-inbox">
                                <button type="submit" class="btn btn-default btn-sm waves-effect"><i class="notika-icon notika-form"></i> حفظ</button>
								<button class="btn btn-default btn-sm waves-effect cntState" id="btnInternalReferral" ><i class="notika-icon notika-left-arrow"></i> إحالة داخلية</button>
								 <button class="btn btn-default btn-sm waves-effect cntState" id="btnIOMReferral" ><i class="notika-icon notika-right-arrow hidden"></i> إحالة الى IOM</button>
                       <button class="btn btn-default btn-sm waves-effect cntState" id="btnExternalReferral" ><i class="notika-icon notika-right-arrow"></i> إحالة خارجية</button>
					     <button class="btn btn-default btn-sm waves-effect " id="btnCloseRequest" ><i class="notika-icon notika-promos"></i> طلب إغلاق الحالة</button>
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
        
    </div>
    <!-- /#wrapper -->
	<div class="modal fade" id="ExternalReferralFormModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
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

	<div class="modal fade" id="CloseCaseModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">إغلاق الحالة</h4>
            </div>
            
                <form data-toggle="validator" role="form" id="frm_CloseCase">
					<div class="modal-body">
					
						
						<div class="form-group"> <label for="Customer_id">سبب الإغلاق<span class="rqd"></span> :</label><textarea class="form-control" id="CloseReason" name="CloseReason" rows="3" required></textarea></div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
						<button type="submit" id="btnCloseCase" class="btn btn-primary">حفظ</button>
					</div>   
                </form>
             
        </div>
    </div>
</div>
<!--  wizard JS
		============================================ -->
    <script src="js/wizard/jquery.bootstrap.wizard.min.js"></script>
    <script src="js/wizard/wizard-active.js"></script>
	

	<script>
		$( "#analysis-page" ).addClass( "active" );
		$( "#Interface" ).addClass( "active" );
	</script>
 <script>
 function findObjectByKey(array, key, value) {
    for (var i = 0; i < array.length; i++) {
        if (array[i][key] === value) {
            return array[i];
        }
    }
    return null;
}
$(function(){

	$('#Valuedservicestable').html(jsValuedServiceData);
	$('#Timedservicestable').html(jsTimedServiceData);
	$('#Echnomicservicestable').html(jsEchonomicServiceData);
	$('#Disabilitiestable').html(JSDisabilitiesString);
	
  
	
	
	var disabilityState=0;
	$('#CaseDisabilityState').on('change',function(e){
		
		if($(this).is(":checked"))
		{$('.DisabilitiesDiv').removeClass('hidden');
	        disabilityState=1;
		}
		else
		{$('.DisabilitiesDiv').addClass('hidden');	 disabilityState=0;}		
	}).trigger('change');
	
	
	$('#Party_id').html(jsAgencyData).on('change',function(e){
		$('#ReceiverPersonName').html(setPeopleOfAgency($(this).val()));
		
	});
	var v=$("#tblCurrentChildData").bootstrapTable('destroy');
		v.bootstrapTable({ data:JsChildData});
$('#frm_child_analysis').on('submit', function (e) {
	e.preventDefault();
			 var dataS=$('#frm_child_analysis').serializeArray();
			 
			  dataS.push({'name':'ChildCaseId','value':'<?php echo isset($param["ChildCaseID"])?$param["ChildCaseID"]:$param["Case_No"]; ?>'});
			  dataS.push({'name':'CaseDisabilityState','value':disabilityState});
				if(!$('input[name="CaseDisabilityId"]').is(":checked") || disabilityState==0 )
					  dataS.push({'name':'CaseDisabilityId','value':0});
		
			 
			
			$.post('AjaxFiles/AjaxNewChildCaseAnalysis.php',dataS,function(r){
				
				//i must set the IsAnalysisExist to true to tell the database that this analysis is exist 
				//( to prevent the duplications of records if the user tried to save the form without refreshing the page)
				if(r != '0')
				{
				let CheckedService=[];
			      let UnCheckedService=[];
			    $('.ServiceRow').each(function(k,i){
				 let currenrRow=$(this);
				 if($('.checkService').eq(k).is(":checked") )
					CheckedService.push($('input[name="ServiceId"]').eq(k).val());
				  else 
					UnCheckedService.push($('input[name="ServiceId"]').eq(k).val());
			 
		         });
				 console.log('Chk:'+r);
				 $.post('AjaxFiles/AjaxSaveAnalysisSgsSrv.php',{AnalysisId:r,checkedSrv:CheckedService,unCheckedSrv:UnCheckedService},function(r2){
					 if(parseInt(r2)>0)
						mkNoti('تم', 'تم الحفظ بنجاح! ', { status: 'success' }); 
					 else
						mkNoti('خطأ', 'الرجاء التأكد من صحة البيانات! ', { status: 'danger' });
					
				 });
					
				$("#IsAnalysisExist").val('1');}
				else
				{mkNoti('خطأ', 'الرجاء التأكد من صحة البيانات! ', { status: 'danger' });}
			});
		});
		$('#btnIOMReferral').on('click',function(e){
		$.post('AjaxFiles/AjaxIomReferral.php',{CaseId:'<?php echo isset($param["ChildCaseID"])?$param["ChildCaseID"]:$param["Case_No"]; ?>'},function(r){
			if(parseInt(r)==1)
				{mkNoti('تم', 'تم الحفظ بنجاح! ', { status: 'success' })}
			else
				mkNoti('خطأ', 'الرجاء التأكد من صحة البيانات! ', { status: 'danger' });
				
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

$('#btnInternalReferral').on('click',function(e){
		$.post('AjaxFiles/AjaxInternalReferral.php',{CaseId:'<?php echo isset($param["ChildCaseID"])?$param["ChildCaseID"]:$param["Case_No"]; ?>'},function(r){
			if(parseInt(r)==1)
				{mkNoti('تم', 'تم الحفظ بنجاح! ', { status: 'success' })}
			else
				mkNoti('خطأ', 'الرجاء التأكد من صحة البيانات! ', { status: 'danger' });
				
		});
	});
	$('#btnPrint').on('click',function(e){
		 window.open('analysis_data_print.php?ChildCaseId=' + '<?php echo isset($param["ChildCaseID"])?$param["ChildCaseID"]:$param["Case_No"]; ?>' , '_blank');	
	});
	$('#frm_CloseCase').on('submit',function(e){
		e.preventDefault();
		$.post('AjaxFiles/AjaxEditCaseClose.php',{caseId:'<?php echo isset($param["ChildCaseID"])?$param["ChildCaseID"]:$param["Case_No"]; ?>',CloseReason:$('#CloseReason').val()},function(r){
			if(r=='1')
			$('#CloseCaseModal').modal('hide');
		});
		
	});
	$('#btnCloseRequest').on('click',function(e){
		$('#CloseCaseModal').modal('show');
		
	});
	
	
});
</script>
<script>
$(function(){
	if(JsCaseData != '1'){
		$.each(JsCaseData,function(k,i)
        {
			$("#CaseAnalysisCaseReason").val(i.Case_reason);
			if(i.Living_status == 399)
				$("#rdbCaseAnalysisLivingStatus1"). prop("checked", true);
			else if(i.Living_status == 400)
				$("#rdbCaseAnalysisLivingStatus2"). prop("checked", true);
			else if(i.Living_status == 401)
				$("#rdbCaseAnalysisLivingStatus3"). prop("checked", true);
			else if(i.Living_status == 402)
				$("#rdbCaseAnalysisLivingStatus4"). prop("checked", true);
			else if(i.Living_status == 403)
				$("#rdbCaseAnalysisLivingStatus5"). prop("checked", true);
			else if(i.Living_status == 404)
				$("#rdbCaseAnalysisLivingStatus6"). prop("checked", true);
			else if(i.Living_status == 405)
				$("#rdbCaseAnalysisLivingStatus7"). prop("checked", true);
			else if(i.Living_status == 406)
				$("#rdbCaseAnalysisLivingStatus8"). prop("checked", true);
			else if(i.Living_status == 407)
				$("#rdbCaseAnalysisLivingStatus9"). prop("checked", true);
			else if(i.Living_status == 408)
				$("#rdbCaseAnalysisLivingStatus10"). prop("checked", true);
			else if(i.Living_status == 409)
				$("#rdbCaseAnalysisLivingStatus11"). prop("checked", true);
			else if(i.Living_status == 410)
				$("#rdbCaseAnalysisLivingStatus12"). prop("checked", true);
				
			if(i.Victim_state == 411)
				$("#rdbCaseAnalysisVictimState1"). prop("checked", true);
			else if(i.Victim_state == 412)
				$("#rdbCaseAnalysisVictimState2"). prop("checked", true);
			else if(i.Victim_state == 413)
				$("#rdbCaseAnalysisVictimState3"). prop("checked", true);
			else if(i.Victim_state == 414)
				$("#rdbCaseAnalysisVictimState4"). prop("checked", true);
				
			if(i.Current_problem == 415)
				$("#rdbtnCurrentIssue1"). prop("checked", true);
			else if(i.Current_problem == 416)
				$("#rdbtnCurrentIssue2"). prop("checked", true);
			else if(i.Current_problem == 417)
				$("#rdbtnCurrentIssue3"). prop("checked", true);
			else if(i.Current_problem == 418)
				$("#rdbtnCurrentIssue4"). prop("checked", true);
			else if(i.Current_problem == 419)
				$("#rdbtnCurrentIssue5"). prop("checked", true);
			else if(i.Current_problem == 420)
				$("#rdbtnCurrentIssue6"). prop("checked", true);
			else if(i.Current_problem == 421)
				$("#rdbtnCurrentIssue7"). prop("checked", true);
			else if(i.Current_problem == 422)
				$("#rdbtnCurrentIssue8"). prop("checked", true);
			else if(i.Current_problem == 525)
				$("#rdbtnCurrentIssue9"). prop("checked", true);
			else if(i.Current_problem == 526)
				$("#rdbtnCurrentIssue10"). prop("checked", true);
			if(i.Disability_state==1)
			{ $('#CaseDisabilityState').attr('checked',true).trigger('change');
		     $('input[name="CaseDisabilityId"]:input[value="'+i.Disability_id+'"]').attr('checked',true);
		
			}
			    
			$('#CaseProtecionIssues').val(i.Protection_issues);
			$("#CaseAnalysisOtherIssues").val(i.Other_issues);
			$("#CaseAnalysisSuggestedPrcByReferralManager").val(i.Suggested_prc_by_referral_manager);
			$("#CaseAnalysisSuggestedPrcByPhsycoSpecialist").val(i.Suggested_prc_by_phsyco_specialist);
			$("#CaseAnalysisSuggestedServices").val(i.Suggested_services);
			//i set the IsAnalysisExist to true to tell the database that this analysis is already there when the form submit
			$("#IsAnalysisExist").val('1');
	     });
	}
	
	if(JsCaseData!= '1'){
		$.each(JsCaseData,function(k,i)
        {
			//$("#ExternalreferralId").val(i.erc_Id);
			$("#Party_id").val(i.Agency_id).trigger('change');
			$("#ReceiverPersonName").val(i.Agency_person_id);
			$("#ExternalreferralNote").val(i.Note);
	     });
	}
	
});

</script>
<?php
echo current($ChildData)["Diagonse_state"];
if(current($ChildData)["Diagonse_state"]==1 || current($ChildData)["Iom_analysis_state"]==1)
{echo '<script>$(function(){$(".cntState").prop("disabled", true);}); </script>';}

 require_once("footer-links.php"); 

 ?>