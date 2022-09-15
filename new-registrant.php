<?php 
require_once("header-links.php");
require_once('AjaxFiles/AjaxAssignChild.php');

$sql =  "SELECT ID,Title, List_type_id ,Parent_id FROM manylist where List_type_id in(1,2,3,25,26) order by Title; ";
$ManyListData=$pdo->query($sql)->fetchAll();
$GovernateData='';
$DistrictData=[];
$RelativeTypeData='';
$ChildSource='';
$ChildNationality='';
foreach ($ManyListData as $md)
{
	if($md['List_type_id']==1)
		$GovernateData.='<option value='.$md['ID'].' >'.$md['Title'].'</option>'; 
	else if($md['List_type_id']==2)
	   array_push($DistrictData,["ID" =>$md['ID'],"Title"=>$md['Title'],"Parent_id"=>$md['Parent_id']]);
	else if($md['List_type_id']==25)
		$ChildSource .='<option value='.$md['ID'].' >'.$md['Title'].'</option>'; 
	else if($md['List_type_id']==26)
		$ChildNationality .='<option value='.$md['ID'].' >'.$md['Title'].'</option>'; 
	else
		$RelativeTypeData.='<option value='.$md['ID'].' >'.$md['Title'].'</option>'; 
}

echo '<script> var jsGovernateData="'.$GovernateData.'";var jsDistrictData='.json_encode($DistrictData).';var jsRelativeTypeData="'.$RelativeTypeData.'"
;var JsChildSourceData="'.$ChildSource.'";var setDstOfGvr=function(GovId)
{ let dst="";
  $.each((jsDistrictData),function(k,i) {if(i.Parent_id==GovId ) dst +="<option value="+i.ID+">"+i.Title+"</option>"; });
	return dst;
};var JsChildNationality="'.$ChildNationality.'"

</script>'; 
?>

<!-- Breadcomb area Start-->
	<div class="breadcomb-area">
		<div class="container">
			<div class="row">
			 <div class="col-lg-1"></div>
				<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 ">
					<div class="breadcomb-list">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="breadcomb-wp">
									<div class="breadcomb-icon">
										<i class="notika-icon notika-support"></i>
									</div>
									<div class="breadcomb-ctn ">
										<h2 id="CurrentScreen">تسجيل طفل جديد</h2>
										<p id="CurrentScreenDescription"> يتم في هذا النموذج تسجيل الاطفال المحتاجين إلى خدمة في اول زيارة لهم فقط.</p>
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

        <!-- Navigation -->
       
        <div id="page-wrapper">
           
            <div class="row">
			 <div class="col-lg-2"></div>
               <div class="col-lg-8">
                    <div class="panel panel-default main-panel">
                      
                <div class="panel-body ">
				 <form role="form" method="POST" id="frm_addChild" data-toggle="validator" role="form">
				 <input type="hidden" id="ChildId" name="ChildId" value="0" />
				 <div class="childInfo">
				   <div class="col-lg-12">
				    <div class="panel panel-default">
				      <div class="panel-heading">
                           بيانات الطفل
                        </div>
						
						 <div class="panel-body">
						 <div class="row">
							   <div class="col-lg-12">
							    <div class="col-lg-4">

                             			   <div class="form-group">
                                            <label>الاسم الاول:</label>
											
                                            <input class="form-control input-sm no-repeat cfrm rltvChg" id="ChildFisrtName" name="ChildFisrtName" required>
                                           
										   <p class="help-block hidden" >Example block-level help text here.</p>
                                        </div>
								  </div>
								  <div class="col-lg-4">
                             			   <div class="form-group">
                                            <label>الاسم الاوسط:</label>
                                            <input class="form-control no-repeat cfrm rltvChg" id="ChildMiddelName" name="ChildMiddelName" required>
                                            <p class="help-block hidden" >Example block-level help text here.</p>
                                        </div>
								  </div>
								   <div class="col-lg-4">
										 <div class="form-group">
                                            <label>الاسم الاخير:</label>
                                            <input class="form-control no-repeat cfrm rltvChg" id="ChildLastName" name="ChildLastName" required>
                                            <p class="help-block hidden">Example block-level help text here.</p>
                                        </div>
										 </div>
										
											 <div class="col-lg-4">
										 <div class="form-group">
                                            <label>العمر:</label>
                                            <input class="form-control cfrm" id="ChildAge" name="ChildAge" type="number" required>
                                            <p class="help-block hidden hidden">Example block-level help text here.</p>
                                        </div>
										</div>
										 <div class="col-lg-4">
										 <div class="form-group">
                                            <label>محافظة الميلاد:</label>
                                           
										<select class="form-control cfrm" id="ChildBirthGov" name="ChildBirthGov" required>
                                                                                   
											</select>
                                        </div>
										</div>
										
								
									 	    <div class="col-lg-4">
								    <div class="form-group">
                                            <label>محافظة السكن:</label>
                                                                                      
                                            <select class="form-control cfrm" id="ChildLivingGov" name="ChildLivingGov" required>
                                         
                                            </select>
                                       
                                            <p class="help-block hidden">Example block-level help text here.</p>
                                        </div>
										 </div>
										 <div class="col-lg-4">
										   <div class="form-group ">
                                            <label>مديرية السكن:</label>
                                              <select class="form-control cfrm" id="ChildLivingDst" name="ChildLivingDst" required>
                                           
                                            </select>
                                            <p class="help-block hidden">Example block-level help text here.</p>
                                        </div> </div>
										 <div class="col-lg-4">
										 <div class="form-group">
                                            <label>العنوان:</label>
                                            <input class="form-control cfrm" id="ChildAddress" name="ChildAddress" required>
                                            <p class="help-block hidden">Example block-level help text here.</p>
                                        </div>
										  </div>
										   <div class="col-lg-4">
										 <div class="form-group">
                                            <label>المصدر:</label>
                                            <select class="form-control " id="ChildSource" name="ChildSource" required></select>
                                            <p class="help-block hidden">Example block-level help text here.</p>
                                        </div>
									</div>
										    <div class="col-lg-4">
										 <div class="form-group">
                                            <label>الجنسية:</label>
                                            <select class="form-control " id="ChildNationality" name="ChildNationality" required></select>
                                            <p class="help-block hidden">Example block-level help text here.</p>
                                        </div>
									</div>
									  <div class="col-lg-4">
										
									</div>
									  <div class="col-lg-4">
										
									</div>
										
										   
								  </div>
								
										<div class="form-group col-lg-6 ">
										
                                            <label>النوع:</label>
                                            <label class="radio-inline">
                                                <input  type="radio" name="ChildGender" id="ChildGender1" value="1" checked >
												<span  class="checkSpan">ذكر</span>
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="ChildGender" id="ChildGender2" value="2"><span  class="checkSpan">انثى</span>
                                            </label>
                                     </div> 
									
									
									 <div class="form-group col-lg-6">
                                            <label>نازح؟:</label>
                                            <label class="radio-inline">
                                                <input  type="radio" name="DisplacedState" id="DisplacedState1" value="0" checked >
												<span  class="checkSpan">لا</span>
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="DisplacedState" id="DisplacedState2" value="1"><span  class="checkSpan">نعم</span>
                                            </label>
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
                          بيانات الوالدين
                        </div>
						
						 <div class="panel-body">
						 <div class="row">
							   <div class="col-lg-6">
                             			 
										<div class="form-group">
                                            <label>حالة الأم:</label>
                                            <label class="radio-inline">
                                                <input type="radio" name="MotherAlive" id="MotherAlive1" value="1" checked><span class="checkSpan" >على قيد الحياة</span>
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="MotherAlive" id="MotherAlive0" value="0">	<span  class="checkSpan">متوفية</span>
                                            </label>
                                           
                                        </div>
										<div class="mother-info">
										 <div class="form-group">
                                            <label>اسم الأم:</label>
                                            <input class="form-control cfrm" id="MotherName" name="MotherName" >
                                            <p class="help-block hidden">Example block-level help text here.</p>
                                        </div>
										 <div class="form-group">
                                            <label>عمل الأم:</label>
                                            <input class="form-control cfrm" id="MotherWork" name="MotherWork">
                                            <p class="help-block hidden">Example block-level help text here.</p>
                                        </div>
										</div>
										
								
							     </div>
								 
								  <div class="col-lg-6">
                                     <div class="form-group">
                                            <label>حالة الأب:</label>
                                            <label class="radio-inline"  >
											
											
                                                <input type="radio" name="FatherAlive" id="FatherAlive1" value="1" checked>
													<span  class="checkSpan">على قيد الحياة</span>										
												
											
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="FatherAlive" id="FatherAlive0" value="0">	<span  class="checkSpan">متوفي</span>
                                            </label>
                                           
                                        </div>
										<div class="father-info">
										 <div class="form-group">
                                            <label> اسم الأب:</label>
                                            <input class="form-control cfrm " id="FatherName" name="FatherName" readonly>
                                            <p class="help-block hidden">Example block-level help text here.</p>
                                        </div>
										 <div class="form-group">
                                            <label>عمل الأب:</label>
                                            <input class="form-control cfrm" id="FatherWork" name="FatherWork">
                                            <p class="help-block hidden">Example block-level help text here.</p>
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
                        بيانات مقدم الرعاية
                        </div>
						<input type="hidden" id="CareGiverId" name="CareGiverId" value="0" />
						 <div class="panel-body">
						 <div class="row">
							   <div class="col-lg-6">
                             			   <div class="form-group">
                                            <label>الاسم الاول:</label>
                                            <input class="form-control cfrm" id="CareGiverFisrtName" name="CareGiverFisrtName" required>
                                            <p class="help-block hidden">Example block-level help text here.</p>
                                          </div>
										 <div class="form-group">
                                            <label>الاسم الاخير:</label>
                                            <input class="form-control cfrm" id="CareGiverLastName" name="CareGiverLastName" required>
                                            <p class="help-block hidden">Example block-level help text here.</p>
                                        </div>
										<div class="form-group">
                                            <label>رقم الهوية:</label>
                                            <input type="number" class="form-control no-repeat cfrm" id="CareGiverIdentity" name="CareGiverIdentity" required>
                                            <p class="help-block hidden">Example block-level help text here.</p>
                                        </div>
										<div class="form-group">
                                            <label>النوع</label>
                                            <label class="radio-inline">
                                                <input type="radio" name="CareGiverGender" id="CareGiverGender1" value="1" checked>
												<span  class="checkSpan">ذكر</span>
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="CareGiverGender" id="CareGiverGender2" value="2"><span  class="checkSpan">انثى</span>
                                            </label>
                                            </div>
										
										
										
								
							     </div>
								  <div class="col-lg-6">
                               <div class="form-group">
                                            <label>صلة القرابة:</label>
                                        
                                          
                                            <select class="form-control rltvChg" id="CareGiverRelationId" name="CareGiverRelationId" required>
                                               
                                            </select>
                                     
                                            <p class="help-block hidden">Example block-level help text here.</p>
                                        </div>
										 <div class="form-group">
                                            <label>رقم الهاتف:</label>
                                            <input type="number" class="form-control cfrm" id="CareGiverPhoneNo" name="CareGiverPhoneNo" required>
                                            <p class="help-block hidden">Example block-level help text here.</p>
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
                         الخدمة المطلوبة
                        </div>
						<input type="hidden" id="CaseId" name="CaseId" value="0" />
						 <div class="panel-body">
						 <div class="row">
							  <div class="form-group">
                                          
                                            <textarea class="form-control cfrm" name="RequiredService" id="RequiredService" rows="3" required></textarea>
                                        </div>
								
								 
								 </div>
								 </div>
				
				          </div>
				         </div>
						</div>	
						<div class="col-lg-4"></div>
						<div class="vw-ml-action-ls text-right mg-t-20">
                            <div class="btn-group ib-btn-gp active-hook nk-email-inbox">
                                <button type="submit" class="btn btn-default btn-sm waves-effect"><i class="notika-icon notika-form"></i> حفظ</button>
                    
                                <button class="btn btn-default btn-sm waves-effect" id="btnPrint"><i class="notika-icon notika-down-arrow"></i> طباعة</button>
                                <a  href="new-registrant.php" id="btnReset" class="btn btn-default btn-sm waves-effect"><i class="notika-icon notika-trash"></i> تهيئة</a>
                            </div>
                        </div>
						
								 </form>
				
				 </div>
			
				
				
				
                    
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
			 <div class="col-lg-2"></div>
        </div>
        <!-- /#page-wrapper -->

    </div>
	  </div>
    <!-- /#wrapper -->
	<!-- Modal -->
<div class="modal fade" id="RepeatedChildModal" tabindex="-1" role="dialog" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close hidden" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">بيانات الجهة</h4>
            </div>
            <div class="modal-body">
                  <h4> بيانات هذه الحالة موجود مسبقاً يمكنك رؤيتها بالنقر <a id='repeatedChildId' > هنا </a> </h4>
             </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default hidden" data-dismiss="modal">الغاء</button>
                <button type="button" id="btnSave hidden" class="btn btn-primary">حفظ</button>
            </div>
        </div>
    </div>
</div>

    <!-- jQuery Version 1.11.0 -->
	<?php require_once("footer-links.php");  ?>
	<script>
		$( "#cases-page" ).addClass( "active" );
		$( "#mailbox" ).addClass( "active" );
	</script>
 <script>
$(function(){
	$('#ChildNationality').html(JsChildNationality);
	$('#ChildSource').html(JsChildSourceData).val(492);
	$('#RequiredService').val('دراسة حالة');
	$('#ChildSource').on('change',function(e){
		if($(this).val()==518)
		{ $('#CareGiverFisrtName').val($('#ChildFisrtName').val()+" "+$('#ChildMiddelName').val()).attr('readonly',true);;
			 $('#CareGiverLastName').val($('#ChildFisrtName').val()).attr('readonly',true);
			$('#CareGiverIdentity').val(111).attr('readonly',true);
			$('#CareGiverPhoneNo').val(111);
			$('#CareGiverRelationId').val(576);
			
			
		}
		else
		{$('#CareGiverRelationId').val(364);
			$('#CareGiverFisrtName').val('').attr('readonly',false);;
			 $('#CareGiverLastName').val('').attr('readonly',false);
			$('#CareGiverIdentity').val('').attr('readonly',false);
			$('#CareGiverPhoneNo').val('');
			
			
		}
		
	});
	//jsGovernateData="'.$GovernateData.'";var jsDistrictData="'.$DistrictData.'";var jsRelativeTypeData
	$('#ChildLivingGov').html(jsGovernateData).on('change',function(e){
		console.log(setDstOfGvr($('#ChildLivingGov').val()));
		$('#ChildLivingDst').html(setDstOfGvr($('#ChildLivingGov').val())).val();
		if($('#ChildLivingGov').val()==11)
			$('#ChildLivingDst').val(50);
		
	}).trigger('change');
	$('#ChildBirthGov').html(jsGovernateData);
	
	$('#CareGiverRelationId').html(jsRelativeTypeData).on('blur',function(e){
		if(parseInt($('#CareGiverRelationId').val())>373)
		{$('#CareGiverFisrtName').val('').attr('readonly',false);
		$('#CareGiverLastName').val('').attr('readonly',false);}
	});
	$('.rltvChg').on('change',function(e){
		$('#FatherName').val($('#ChildMiddelName').val() + ' '+$('#ChildLastName').val());
		if($('#CareGiverRelationId').val()==364)
		{$('#CareGiverFisrtName').val($('#ChildMiddelName').val()).attr('readonly',true);
         $('#CareGiverLastName').val($('#ChildLastName').val()).attr('readonly',true);
		}
		else if(parseInt($('#CareGiverRelationId').val())>365 && parseInt($('#CareGiverRelationId').val())<374  )
		{$('#CareGiverFisrtName').val('').attr('readonly',false);
         $('#CareGiverLastName').val($('#ChildLastName').val()).attr('readonly',true);
		}
	});
	$('#CareGiverRelationId').on('change',function(e){
		if(parseInt($('#CareGiverRelationId').val())>373)
		{$('#CareGiverFisrtName').val('').attr('readonly',false);
		$('#CareGiverLastName').val('').attr('readonly',false);}
	});
$('input[name="MotherAlive"]').on('change',function(e){
	if($('#MotherAlive0').is(':checked'))
		 $('.mother-info').hide();
	 else
		 $('.mother-info').show();
		 
		
});
$('input[name="FatherAlive"]').on('change',function(e){
	if($('#FatherAlive0').is(':checked'))
		 $('.father-info').hide();
	 else
		 $('.father-info').show();
		 
		
});
if(	parseInt($('#ChildId').val())==0){
$('.no-repeat').on('blur',function(e){
	let emptyValidator=true;
	$('.no-repeat').each(function(v){
		if($(this).val()=='')
		{	emptyValidator=false;		 return false;}
	  
		
		 
		
	});
	if(emptyValidator)
	{ let data2Chk=$('.no-repeat').serializeArray();
console.log(data2Chk);
		$.post('AjaxFiles/AjaxCheckChildReplication.php',data2Chk,function(r){
			if(parseInt(r)>0)
			{
				$('#repeatedChildId').attr("href", 'new-registrant.php?ID='+r);
				$('#RepeatedChildModal').modal('show');
			}
			
			 
		});
	}
	
});
}

$('#frm_addChild').on('submit', function (e) {
			 var dataS=$('#frm_addChild').serializeArray();
			  console.log(dataS);
			e.preventDefault();
			$.post('AjaxFiles/AjaxNewRegistrant.php',dataS,function(r){
				
				   // let res=JSON.parse(r);
				  // console.log(res.result);
				    	if(parseInt(r)>0   )
						  {
							  $('#ChildId').val(r);
							mkNoti('تم', 'تم الحفظ بنجاح! ', { status: 'success' });
							  
						  }
					  else
					  {
						  console.log(r)
						  mkNoti('خطأ', 'الرجاء التأكد من صحة البيانات! ', { status: 'danger' });
					  }
					
							
				
			
			});
		});
        
$('#btnPrint').on('click',function(e){
            window.open('child_data_print.php?ChildId=' + $('#ChildId').val() , '_blank');	
	
});

});

</script>
<script>
$(function(){
	if(JsChildData != '1'){
		$.each(JsChildData,function(k,i)
        {
			$('#ChildSource').val(i.Child_source).trigger('change');
			$('#ChildNationality').val(i.ChildNationality).trigger('change');
			$("#ChildId").val(i.ID);
			$("#ChildFisrtName").val(i.chiled_first_name);
			$("#ChildMiddelName").val(i.chiled_middel_name);
			$("#ChildLastName").val(i.chiled_last_name);
			//$("#ChildBirthDate").val(i.Birth_date);
			$("#ChildBirthGov").val(i.Birth_place);
		
			if(i.Gender == 2)
				$("#ChildGender2"). prop("checked", true);
			//$("#ChildGender").val(i.Gender);
			$("#ChildLivingGov").val(i.Living_governate).trigger('change');
			$("#ChildLivingDst").val(i.Living_district);
			$("#ChildAddress").val(i.Address);
			if(i.Mother_alive == 0)
			{$("#MotherAlive0"). prop("checked", true);
		     $('input[name="MotherAlive"]').trigger('change');
			}
			//$("#MotherAlive").val(i.Mother_alive);
			$("#MotherName").val(i.Mother_name);
			$("#MotherWork").val(i.Mother_work);
			if(i.Father_alive == 0)
			{$("#FatherAlive0"). prop("checked", true);
		      $('input[name="FatherAlive"]').trigger('change');
			}
			//$("#FatherAlive").val(i.Father_alive);
			$("#FatherName").val(i.Father_name);
			$("#FatherWork").val(i.Father_work);
			$("#CareGiverId").val(i.Care_giver_id);
			$("#CareGiverFisrtName").val(i.giver_first_name);
			$("#CareGiverLastName").val(i.giver_last_name);
			$("#CareGiverIdentity").val(i.Identity_no);
			if(i.care_gender == 2)
				$("#CareGiverGender2").prop("checked", true);
				
			if(i.Displaced == 1)
				$("#DisplacedState2").prop("checked", true);
			$("#CareGiverRelationId").val(i.Care_giver_relation_id);
			$("#CareGiverPhoneNo").val(i.Phone_no);
			$("#CaseId").val(i.CaseId);
			$("#RequiredService").val(i.Required_service);
			$("#ChildAge").val(i.Age);
			
			
	     });
		 
	}
});

</script>