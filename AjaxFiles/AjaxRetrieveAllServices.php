<?php 
 require_once('../dbconfig.php');

 $ReturnedService='';
 $param=$_REQUEST;
 $CheckedServices=[];
 
 $sql = "select cs.Case_id,cs.Service_id,cs.Quantity,case when cs.Start_date is null then now() else cs.Start_date end as Start_date  ,cs.Service_giver_id,case when cs.End_date is null then now()  else cs.End_date end as End_date,cs.Service_state_id,s.id as ActualSeviceId,s.Title ServiceTitle,s.Service_cat
  , case when cs.Service_id is null then 0 else 1 end as checkedState,checkCaseDiagnoseState(cs.Case_id) as DiagnoseState from caseservice cs right outer join service s  on (cs.Service_id=s.ID and cs.Case_id=".$param['Case_Id'].") where Service_cat =".$param['Service_Cat_Id']; 
  $Services=$pdo->query($sql)->fetchAll();
  
  
  function getServiceGiverData($SrvGvrId){
  $sql = "select * from userview where user_type_id in (523,433) and ID!=".$_SESSION['user_id']."; ";
  $ResoposnibleUsers=$GLOBALS['pdo']->query($sql)->fetchAll();
  $ResoposnibleUsersCmb="";
	
	 foreach($ResoposnibleUsers as $RP)
	 if($RP["ID"]==$SrvGvrId)
         $ResoposnibleUsersCmb.="<option value=".$RP["ID"]." selected>".$RP["First_name"].' '.$RP["Last_name"]."</option>";
      else
		   $ResoposnibleUsersCmb.="<option value=".$RP["ID"]." >".$RP["First_name"].' '.$RP["Last_name"]."</option>"; 
    return $ResoposnibleUsersCmb;
 }
  
  
    if($param['Service_Cat_Id']==381)
	{ $ReturnedService .="<thead><th>*</th> <th>اسم الخدمة</th> <th>تاريخ البدء</th> <th>تاريخ الانتهاء</th> <th>الشخص المسؤول</th> </thead>";
	  foreach($Services as $srv)
         {
	      $ReturnedService .='<tr class="unread ServiceRow"><td class=""><label><input type="checkbox"  class="i-checks checkService" name="checkService"'; 
	    if($srv['checkedState']==1)
		{
			
				 $ReturnedService .=' checked ';
			 if($srv['DiagnoseState']==1)
			 { array_push( $CheckedServices,  [
		'ServiceId'   =>$srv['ActualSeviceId']]);
		 $ReturnedService .=' disabled></label></td> <input type="hidden" id="ServiceId" name="ServiceId" value="'.$srv['ActualSeviceId'].'" /><td>'.$srv['ServiceTitle'].'</td><td><input type="date" class="form-control serviceControl" id="Service_starting_date" name="Service_starting_date" value='.date('Y-m-d',strtotime($srv['Start_date'])).' readonly></td><td><input type="date" class="form-control serviceControl" id="Service_end_date" name="Service_end_date" value='.date('Y-m-d',strtotime($srv['End_date'])).' readonly></td><td ><select  class="form-control serviceControl ResbonsiblePersonId cntState"  id="ResbonsiblePersonId" name="ResbonsiblePersonId"  >'.getServiceGiverData($srv['Service_giver_id']).'</select></td>  </tr>';
			 }
			 else
			 {array_push( $CheckedServices,  [
		'ServiceId'   =>$srv['ActualSeviceId']]);
		 $ReturnedService .='></label></td> <input type="hidden" id="ServiceId" name="ServiceId" value="'.$srv['ActualSeviceId'].'" /><td>'.$srv['ServiceTitle'].'</td><td><input type="date" class="form-control serviceControl" id="Service_starting_date" name="Service_starting_date" value='.date('Y-m-d',strtotime($srv['Start_date'])).' ></td><td><input type="date" class="form-control serviceControl" id="Service_end_date" name="Service_end_date" value='.date('Y-m-d',strtotime($srv['End_date'])).' ></td><td><select class="form-control serviceControl ResbonsiblePersonId" id="ResbonsiblePersonId" name="ResbonsiblePersonId" >'.getServiceGiverData($srv['Service_giver_id']).'</select></td>  </tr>';
		
				 
			 }
		}
	   else
	    $ReturnedService .='></label></td> <input type="hidden" id="ServiceId" name="ServiceId" value="'.$srv['ActualSeviceId'].'" /><td>'.$srv['ServiceTitle'].'</td><td><input type="date" class="form-control serviceControl" id="Service_starting_date" name="Service_starting_date" value='.date('Y-m-d',strtotime($srv['Start_date'])).' ></td><td><input type="date" class="form-control serviceControl" id="Service_end_date" name="Service_end_date" value='.date('Y-m-d',strtotime($srv['End_date'])).' ></td><td><select class="form-control serviceControl ResbonsiblePersonId" id="ResbonsiblePersonId" name="ResbonsiblePersonId" >'.getServiceGiverData(0).'</select></td>  </tr>';
	 
          }
	 
	}
	 else
	 { $ReturnedService .= "<thead> <th>*</th><th>اسم الخدمة</th> <th>تاريخ تقديم الخدمة</th> </thead>"; 
          foreach($Services as $srv)
         {
	     $ReturnedService .='<tr class="unread ServiceRow"><td class=""><label><input type="checkbox"   class="i-checks checkService" name="checkService" ';
	    if($srv['checkedState']==1)
		{$ReturnedService .=' checked';
	    array_push( $CheckedServices,  [
		'ServiceId'   =>$srv['ActualSeviceId']]);
		}
	 
	    $ReturnedService .='></label></td> <input type="hidden" id="ServiceId" name="ServiceId" value="'.$srv['ActualSeviceId'].'" /><td>'.$srv['ServiceTitle'].'</td><td><input type="date" class="form-control serviceControl" id="Service_starting_date" name="Service_starting_date" value='.date('Y-m-d',strtotime($srv['Start_date'])).' ></td>  </tr>';
	 
          }
 
	 }
  

 
 echo  $ReturnedService.'Delemiter'.json_encode($CheckedServices);



 ?>


