<?php require_once('print_header.php');require_once('dbconfig.php');


?>
<body onload="window.print()">
<div id="wrapper" >

        <!-- Navigation -->
       
        <div id="page-wrapper">
           <div class="container">
		    <div class="col-sm-12">
            <div class="row">
			
			<div class="col-sm-4"><h3 class="small-line">  بيانات الطفل الاساسية : </h3></div>
			
		<table class="table table-bordered " >
	 <thead>
	 <th  data-field="childId" >الاسم الاول</th>
		<th data-field="ChildFullName"  >الاسم الاوسط</th>
		<th  data-field="Gender" >الاسم الاخير</th>
		<th  data-field="CareGiverFullName" >العمر</th>
	
	 
	 </thead>
	 <tbody>
	<tr>
	<td><input class="form-control no-repeat cfrm rltvChg" id="ChildLastName" name="ChildLastName" required> </td>
	<td><input class="form-control no-repeat cfrm rltvChg" id="ChildLastName" name="ChildLastName" required> </td>
	 <td><input class="form-control no-repeat cfrm rltvChg" id="ChildLastName" name="ChildLastName" required> </td>
	<td><input class="form-control no-repeat cfrm rltvChg" id="ChildLastName" name="ChildLastName" required> </td>
	 
	 
	</tr>
	</tbody>
	 </table>
	  <table class="table table-bordered " >
	 <thead>
	 <th  data-field="childId" >محافظة الميلاد</th>
		<th data-field="ChildFullName"  >محافظة السكن</th>
		<th  data-field="Gender" >مديرية السكن</th>
		<th  data-field="CareGiverFullName" >العنوان</th>
	
	 
	 </thead>
	 <tbody>
	<tr>
	<td><input class="form-control no-repeat cfrm rltvChg" id="ChildLastName" name="ChildLastName" required> </td>
	<td><input class="form-control no-repeat cfrm rltvChg" id="ChildLastName" name="ChildLastName" required> </td>
	 <td><input class="form-control no-repeat cfrm rltvChg" id="ChildLastName" name="ChildLastName" required> </td>
	<td><input class="form-control no-repeat cfrm rltvChg" id="ChildLastName" name="ChildLastName" required> </td>
	 
	 
	</tr>
	</tbody>
	 </table>
	 <table class="table table-bordered " >
	 <thead>
	 <th  data-field="childId" >النوع</th>
		<th data-field="ChildFullName"  >نازح؟</th>
			 
	 </thead>
	 <tbody>
	<tr>
	<td>
                                           
                                            <label class="radio-inline">
                                                <input  type="radio" name="ChildGender" id="ChildGender" value="1"  >
												<span  class="checkSpan">ذكر</span>
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="ChildGender" id="ChildGender" value="2"><span  class="checkSpan">انثى</span>
                                            </label>
                                    
									</td>
	<td> 
                                           
                                            <label class="radio-inline">
                                                <input  type="radio" name="DisplacedState" id="DisplacedState" value="0"  >
												<span  class="checkSpan">لا</span>
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="DisplacedState" id="DisplacedState" value="1"><span  class="checkSpan">نعم</span>
                                            </label>
                                     </td>
		 
	 
	</tr>
	</tbody>
	 </table>
            
	
<div class="col-sm-4"><h3 class="small-line">   بيانات الوالدين :</h3></div>
							  <table class="table table-bordered " >
	 <thead>
	 <th  data-field="childId" >حالة الأم</th>
		<th data-field="ChildFullName"  >اسم الأم</th>
		<th  data-field="Gender" >عمل الأم</th>
	
	
	 
	 </thead>
	 <tbody>
	<tr>
	<td><label class="radio-inline"><input type="radio" name="MotherAlive" id="MotherAlive" value="1" ><span class="checkSpan" >حي</span></label> <label class="radio-inline"><input type="radio" name="MotherAlive" id="MotherAlive" value="0">	<span  class="checkSpan">متوفية</span></label> </td>
	<td><input class="form-control no-repeat cfrm rltvChg" id="ChildLastName" name="ChildLastName" required> </td>
	<td><input class="form-control no-repeat cfrm rltvChg" id="ChildLastName" name="ChildLastName" required> </td>
	</tr>
	</tbody>
	 </table>
	  <table class="table table-bordered " >
	 <thead>
	 <th  data-field="childId" >حالة الأب</th>
		<th data-field="ChildFullName"  >اسم الأب</th>
		<th  data-field="Gender" >عمل الأب</th>
	
	
	 
	 </thead>
	 <tbody>
	<tr>
	<td><label class="radio-inline"><input type="radio" name="MotherAlive" id="MotherAlive" value="1" ><span class="checkSpan" >حي</span></label> <label class="radio-inline"><input type="radio" name="MotherAlive" id="MotherAlive" value="0">	<span  class="checkSpan">متوفي</span></label> </td>
	<td><input class="form-control no-repeat cfrm rltvChg" id="ChildLastName" name="ChildLastName" required> </td>
	<td><input class="form-control no-repeat cfrm rltvChg" id="ChildLastName" name="ChildLastName" required> </td>
	</tr>
	</tbody>
	 </table>	   
	 <div class="col-sm-4"><h3 class="small-line">     بيانات مقدم الرعاية :</h3></div>
				  <table class="table table-bordered " >
	 <thead>
	 <th  data-field="childId" >الاسم الاول</th>
		<th data-field="ChildFullName"  >الاسم الاخير</th>
		<th  data-field="Gender" >رقم الهوية</th>
		<th  data-field="Gender" >صلة القرابة</th>
		
	
	
	 
	 </thead>
	 <tbody>
	<tr>
	<td><input class="form-control no-repeat cfrm rltvChg" id="ChildLastName" name="ChildLastName" required> </td>
	<td><input class="form-control no-repeat cfrm rltvChg" id="ChildLastName" name="ChildLastName" required> </td>
	<td><input class="form-control no-repeat cfrm rltvChg" id="ChildLastName" name="ChildLastName" required> </td>
		<td><input class="form-control no-repeat cfrm rltvChg" id="ChildLastName" name="ChildLastName" required> </td>
	
	</tr>
	</tbody>
	 </table>
	  <table class="table table-bordered " >
	 <thead>
	 <th  data-field="childId" >رقم الهاتف</th>
		<th data-field="ChildFullName"  >النوع</th>
		
	 </thead>
	 <tbody>
	<tr>
			<td><input class="form-control no-repeat cfrm rltvChg" id="ChildLastName" name="ChildLastName" required> </td>
	<td> <label class="radio-inline">
                                                <input  type="radio" name="ChildGender" id="ChildGender" value="1"  >
												<span  class="checkSpan">ذكر</span>
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="ChildGender" id="ChildGender" value="2"><span  class="checkSpan">انثى</span>
                                            </label></td>
	</tr>
	</tbody>
	 </table>
	 </div>
</div>						
						
						
						
								
				
				 </div>
			
				
				
				
                    
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
	</body>		