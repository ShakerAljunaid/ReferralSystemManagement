 <?php 
		         
      $sql = 'SELECT  * from  childGridViewData where Iom_analysis_state=0'; 
	  if($UserType!=436)
        $sql .=' and  Iom_analyst_id='.$UserId;
  
 
$ChildData = $pdo->query($sql)->fetchAll();
echo '<script> var JsPendingIomCases='.json_encode($ChildData).';</script>';
 
 ?>
 
 <div class="modal fade" id="AllPendingIomCasesModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width:60%;">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="PendingChildren">جميع الحالات المعلقة</h4>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-hover table-striped"
						data-toggle="table"
			 data-search="true"
			 data-filter-control="true" 
			 data-show-export="true"
			 data-click-to-select="true"
			 data-toolbar="#toolbar"
			  data-show-pagination-switch="true" data-pagination="true" data-id-field="ID" data-page-size="50"  data-side-pagination="client"
            class="table-responsive " id="MdltblMdlIOMPendingChildren"	   >
										<thead>
                                                <tr>
												 <th  data-field="childId" data-filter-control="input" data-sortable="true">الرقم</th>
													<th data-field="ChildFullName" data-filter-control="input" data-sortable="true" >اسم الطفل</th>
                                                    <th  data-field="Gender" data-filter-control="input" data-sortable="true">النوع</th>
													<th  data-field="CareGiverFullName" data-filter-control="input" data-sortable="true">اسم المُعتني</th>
													<th  data-field="CareGiverPhoneNo" data-filter-control="input" data-sortable="true">رقم الهاتف</th>
													<th  data-field="ChildAddress" data-filter-control="input" data-sortable="true"> العنوان</th>
                                                    <th data-formatter="CaseSubmitFormatter" >استلام الحالة</th>
													
													
 
  
												</tr>
                                            </thead>
                                             <tbody >
											
											 </tbody>
                                        </table>
             </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">خروج</button>
               
            </div>
        </div>
    </div>
</div>
 <script>
 
 $(function(){
	 
	 $("#btnShowAllPendingIomAnalysisModal").on('click',function(e){
		 $("#AllPendingIomCasesModal").modal('show');
		 
		 
	 });
 
  let t=$("#PendingIomAnalysisChildrenCases").bootstrapTable('destroy');
  let m=$("#MdltblMdlIOMPendingChildren").bootstrapTable('destroy');
   let pl= [];
   if(JsPendingIomCases.length>3)
      pl.push(JsPendingIomCases[0],JsPendingIomCases[1],JsPendingIomCases[2]);
   else pl=JsPendingIomCases;
  		//jQuery.fn.bootstrapTable.defaults.escape=false;
		m.bootstrapTable({ data:JsPendingIomCases});
		t.bootstrapTable({ data:pl});
		$('#NoOfPendingIomAnalysisCases').html(JsPendingIomCases.length);
		$('.pendingIomChildrenCases .pull-right').after('<i class="notika-icon notika-left-arrow"></i>').addClass('search-people');
	});
 function IomCaseChildNameFormatter(value, row, index) {
		 return [
        '<div class="hd-message-sn"><div class="hd-message-img chat-img"> <img src="img/post/1.jpg" alt="" /> <div class="chat-avaible"><i class="notika-icon notika-dot"></i></div></div><div class="hd-mg-ctn"> <a href=iom_analysis.php?Case_No='+row.caseId+'><h3>'+row.ChildFullName+'</h3></a><a class="like btnEditContract"  title="Like" href="iom_analysis.php?Case_No='+row.caseId+'">',
        '<i class="fa fa-edit"></i> <span class="label label-primary">إستلام</span>',
        '</a></div></div>'
		 ].join('');
	
   
}


function IomCaseSubmitFormatter(value, row, index) {
	 return [
        '<a class="like btnEditContract"  title="Like" href="iom_analysis.php?Case_No='+row.caseId+'">',
        '<i class="fa fa-edit"></i> <span class="label label-primary">إستلام</span>',
        '</a>'
		
        
    ].join('');
	
   
}


</script>
