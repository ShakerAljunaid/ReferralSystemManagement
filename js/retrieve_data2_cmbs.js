var ServiceCat='',Services='',Governate='',District="",Agency="",AgencyContactPeople="";
$.each(jsManyLists,function(k,i)
{
	if(i.Type_id==1)
		ServiceCat+='<option value='+i.ID+'>'+i.Title+'</option>';
	
});



var ServicesOfCat=function(ServiceCatId)
{  let Services="";

  if (ServiceCatId==1)
  { Services="<thead><th>*</th> <th>اسم الخدمة</th> <th>تاريخ البدء</th> <th>تاريخ الانتهاء</th> <th>الشخص المسؤول</th> </thead>"; 
    $.each(jsManyLists,function(k,i)
        {
	  if(i.Type_id==2 && i.Parent_id==ServiceCatId)
	      Services+='<tr class="unread ServiceRow"><td class=""><label><input type="checkbox" checked=""  class="i-checks checkService" name="checkService" ></label></td> <input type="hidden" id="ServiceId" name="ServiceId" value="'+i.ID+'" /><td>'+i.Title+'</td><td><input type="date" class="form-control serviceControl" id="Service_starting_date" name="Service_starting_date" ></td><td><input type="date" class="form-control serviceControl" id="Service_end_date" name="Service_end_date" ></td><td><select class="form-control serviceControl" id="ResbonsiblePersonId" name="ResbonsiblePersonId" ></select></td>  </tr>';
        });
  }
 
 else 
	{ Services="<thead> <th>*</th><th>اسم الخدمة</th> <th>تاريخ تقديم الخدمة</th> </thead>"; 
       $.each(jsManyLists,function(k,i)
        {
	     if(i.Type_id==2 && i.Parent_id==ServiceCatId)
	      Services+='<tr class="unread ServiceRow"><td class=""><label><input type="checkbox" checked=""  class="i-checks checkService" name="checkService" ></label></td> <input type="hidden" id="ServiceId" name="ServiceId" value="'+i.ID+'" /><td>'+i.Title+'</td><td><input type="date" class="form-control serviceControl" id="Service_starting_date" name="Service_starting_date" ></td>  </tr>';
		});
  }	
	
return 	Services;
	
};