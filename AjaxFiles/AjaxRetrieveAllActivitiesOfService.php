<?php 
 require_once('../dbconfig.php');

 $ReturnedService='';
 $param=$_REQUEST;
 $CheckedServices=[];
 
 $sql = "select * from serviceactivitymonitor where Case_activity_id=".$param['caseserviceid'];
 $ChildActivities=$pdo->query($sql)->fetchAll();
  
  $sql = "select * from activities_by_caseservice_id  where CaseServiceId =".$param['caseserviceid'];
  $ServiceActivities=$pdo->query($sql)->fetchAll();
  $ServiceActivitiesCmb="";
  foreach($ServiceActivities as $SA)
   $ServiceActivitiesCmb.="<option value=".$SA["ActivityId"].">".$SA["ActivityTitle"]."</option>";
 
  
  
    if($param['Service_Cat_Id']==2)
	{ $ReturnedActivities .= "<thead> <th>*</th><th>النشاط</th> <th>التاريخ</th><th>وقت البدء</th><th>وقت الانتهاء</th><th>التقييم</th><th>ملاجظات</th> </thead>"; 
	  foreach($ChildActivities as $CACT)
         {
	      $ReturnedService .='<tr ><input type="hidden" id="ServiceActivityId" name="ServiceActivityId" value="'.$CACT['ID'].'" /><td class="">'.; 
	    if($srv['checkedState']==1)
		{ $ReturnedService .=' checked';
	     array_push( $CheckedServices,  [
		'ServiceId'   =>$srv['ActualSeviceId']]);
		}
	 
	    $ReturnedServiceActivities .='></label></td> <input type="hidden" id="ServiceActivityId" name="ServiceActivityId" value="'.$srv['ActualSeviceId'].'" /><td>'.$srv['ServiceTitle'].'</td><td><input type="date" class="form-control serviceControl" id="Service_starting_date" name="Service_starting_date" value='.date('Y-m-d',strtotime($srv['Start_date'])).' ></td><td><input type="date" class="form-control serviceControl" id="Service_end_date" name="Service_end_date" value='.date('Y-m-d',strtotime($srv['Start_date'])).' ></td><td><select class="form-control serviceControl" id="ResbonsiblePersonId" name="ResbonsiblePersonId" >'.$ResoposnibleUsersCmb.'</select></td>  </tr>';
	 
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


