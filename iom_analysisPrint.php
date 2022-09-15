<?php 
require_once('print_header.php');require_once('dbconfig.php');
 
if(isset($_REQUEST["Case_No"]))
{
$ChildCaseID=$_REQUEST["Case_No"];	

   $sql = 'SELECT  * from  childGridViewData where caseId='.$_GET["Case_No"]; 
$ChildData = current($pdo->query($sql)->fetchAll());
$sql='SELECT * from iomanalysis where Case_id='.$_GET["Case_No"];
	$IomAnalysisData=current($pdo->query($sql)->fetchAll());
}
?>

<div class="Agency-fluid fill">
   <br />
   <div class="breadcomb-area">
		<div class="container">
			<div class="row">
				<h2 id="CurrentScreen">تحليل الحالة</h2>
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
                           
                            <div class="wizard-hd">
                            <h2>بيانات الطفل</h2>
                          <div class="child-data">
							   <table class="table table-bordered table-striped" >
	 <thead>
	 <th  data-field="caseId" >الرقم</th>
		<th data-field="ChildFullName"  >اسم الطفل</th>
		<th  data-field="Gender" >النوع</th>
		<th  data-field="Age" >العمر</th>
		<th  data-field="CareGiverFullName" >مقدم الرعاية</th>
		<th  data-field="CareGiverPhoneNo" >رقم الهاتف</th>
		<th  data-field="ChildAddress" > العنوان</th>
	 </thead>
	<tr>
	<td> <?php echo $ChildData['caseId'] ; ?></td>
	<td> <?php echo $ChildData['ChildFullName'] ; ?></td>
	 <td> <?php echo $ChildData['Gender'] ; ?></td>
	  <td> <?php echo $ChildData['Age'] ; ?></td>
	<td> <?php echo $ChildData['CareGiverFullName'] ; ?></td>
	 <td> <?php echo $ChildData['CareGiverPhoneNo'] ; ?></td>
	 <td> <?php echo $ChildData['ChildAddress'] ; ?></td>
	</tr>
	
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
                                            <?php echo $IomAnalysisData['Family_bg'] ; ?>
                                        </td>
                                    </tr>
                                    <tr class="odd gradeX">
                                        <td> التسلسل الزمني للحالة</td>
                                      
                                        <td> <?php echo $IomAnalysisData['State_history'] ; ?></td>
                                    </tr>
                                    <tr class="odd gradeX">
                                        <td>  المشاكل والتوقعات التي عبر عنها الحالة</td>
                                       
                                        <td> <?php echo $IomAnalysisData['Problems_suggestions'] ; ?></td>
                                    </tr>
                                    <tr class="odd gradeX">
                                        <td> الحالة الصحية (جسدية ،نفسية،عقلية) بعد الاستشارة الطبية</td>
                                     
                                        <td> <?php echo $IomAnalysisData['Child_total_state'] ; ?></td>
                                    </tr>
                                    <tr class="odd gradeX">
									
                                        <td> التدخلات التي تم تقديمها عبر المنظمة</td>

                                        <td> <?php echo $IomAnalysisData['Org_prv_interventions'] ; ?></td>
                                    </tr>
										
									 
									  
                                   </table >
								   
	   <table class="table table-bordered ";
								style="height:10%"
								   >
								   <tr >
								   <td > مجري المقابلة </td>
								    <td> رقم الهاتف </td>
									 <td> اسم المركز </td>
									  <td> التوقيع </td>
								   </tr>
								    <tr>
									 <td>حسام الصفواني</td>
									  <td>772808013</td>
									   <td>CRP</td>
									    <td>   </td>
								   </tr>
								   
								   

							
                                   
                                </tbody>
                            </table>
                        
                          
					
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


