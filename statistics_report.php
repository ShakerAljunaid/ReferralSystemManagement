
 <?php require_once("header-links.php"); 
 	$sql = 'SELECT *, (male+female) as allchilds, (pending+recived+external+noneed+internal) AS Allcases from child_gender_summary JOIN case_status_summary ;';
	$ReportData = current($pdo->query($sql)->fetchAll());
  $sql = 'SELECT * from SrvCatStc;';
  $SrvCat = $pdo->query($sql)->fetchAll();
   $sql = 'SELECT * from NoOfServicesByGender ;';
  $GenderAndServiceReport = $pdo->query($sql)->fetchAll();
   $sql = 'SELECT * from NoOfBeneficiariesByActivitie ;';
  $ActivityBeneficiariesReport = $pdo->query($sql)->fetchAll();
   $sql = 'SELECT * from child_displaced_status ;';
  $DisplacedAndNone = $pdo->query($sql)->fetchAll();
  $TotalNoSevices=0;$TotalFrnEnvBnf=0;$TotalPsychBnf=0;$NoOfDisplaced=0;$NoOfNoneDisplaced=0;
   foreach ($DisplacedAndNone as $dspN)
   { if($dspN['dspStatus']==0)
       $NoOfNoneDisplaced +=$dspN['NoOfChildren'];
      else 
		$NoOfDisplaced +=  $dspN['NoOfChildren'];
   
   }
   $NoOfPhyscologyServices=0;
  foreach($GenderAndServiceReport as $srvRpt)
  {if($srvRpt["ServiceId"]==10) 
  $NoOfPhyscologyServices =$srvRpt["NoOfBnfMales"]+$srvRpt["NoOfBnfFemales"];}
  foreach ($SrvCat as $srCt)
    $TotalNoSevices +=$srCt['NoOfSrv'];
  foreach ($ActivityBeneficiariesReport as $actBnf)
  { if($actBnf['Service_id']==10)
       $TotalPsychBnf +=$actBnf['NoOfBeneficiaries'];
     else $TotalFrnEnvBnf +=$actBnf['NoOfBeneficiaries'];
		 
  }
	 
echo '<script> var ServiceCats='.json_encode($SrvCat).';var GenSrvRpt='.json_encode($GenderAndServiceReport).';var actBnfRpt='.json_encode($ActivityBeneficiariesReport).';</script>';	
 ?>
  <link rel="stylesheet" href="css/charts_style.css">

    <div class="notika-status-area">
        <div class="container">
            <div class="row">
			<div class="col-lg-12">
                    <h1 class="page-header">تقارير عامة</h1>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
                    <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30">
                        <div class="website-traffic-ctn">
                            <h2><span class="counter"><?php echo $ReportData['allchilds']; ?></span> مستفيد</h2>
                            <p> عدد المستفيدين المسجلين في النظام  </p>
                        </div>
                        <div class="sparkline-bar-stats1">9,4,8,6,5</div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
                    <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30">
                        <div class="website-traffic-ctn">
                            <h2><span class="counter"><?php echo $TotalNoSevices; ?></span> خدمة</h2>
                            <p> إجمالي عدد الخدمات المقدمة  </p>
                        </div>
                        <div class="sparkline-bar-stats2">1,4,8,3,5</div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
                    <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30 dk-res-mg-t-30">
                        <div class="website-traffic-ctn">
                            <h2>  <span class="counter"><?php echo $TotalFrnEnvBnf; ?></span> مستفيد</h2>
                            <p>عدد المستفيدين من انشطة من المساحات الصديقة</p>
                        </div>
                        <div class="sparkline-bar-stats3">4,2,8,2,5</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30 dk-res-mg-t-30">
                        <div class="website-traffic-ctn">
                            <h2><span class="counter"><?php echo $NoOfPhyscologyServices; ?></span> مستفيد</h2>
                            <p>عدد المستفيدين من الاستشارات النفسية</p>
                        </div>
                        <div class="sparkline-bar-stats4">2,4,8,4,5</div>
                    </div>
                </div>
				<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30 dk-res-mg-t-30">
                        <div class="website-traffic-ctn">
                            <h2><span class="counter"><?php echo $TotalPsychBnf; ?></span> مستفيد</h2>
                            <p>عدد المستفيدين من انشطة من الاستشارات النفسية</p>
                        </div>
                        <div class="sparkline-bar-stats4">2,4,8,4,5</div>
                    </div>
                </div>
				
				
				
            </div>
        </div>
    </div>
    <!-- End Status area-->
    <!-- Start Sale Statistic area-->
    <div class="sale-statistic-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                 
                        
                    <div class="col-sm-4"> 
					  <div class="panel panel-default">
					<div class="panel-heading">
                          الخدمات حسب الفئات
                        </div> <div  id="ServiceChart"></div></div></div>
					<div class="col-sm-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                        الخدمات حسب انواع المستفيدين
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div id="morris-bar-chart"></div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
				
                
				
                </div>
				  
                
            </div>
			<br/>
			<div class="row">
			<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
				<div class="panel panel-default">
				 <div class="panel-heading">
                         تفاصيل المستفيدين
                        </div>
                    <div class="email-statis-inner notika-shadow">
                        <div class="email-ctn-round">
						
                          
                            <div class="email-statis-wrap hidden">
                                <div class="email-round-nock">
                                    <input type="text" class="knob" value="0" data-rel="<?php echo $NoOfNoneDisplaced+$NoOfDisplaced; ?>" data-linecap="round" data-width="130" data-bgcolor="#E4E4E4" data-fgcolor="#00c292" data-thickness=".10" data-readonly="true">
                                </div>
                                <div class="email-ctn-nock">
                                    <p>عدد المستفيدين الاجمالي</p>
                                </div>
                            </div>
							 <div class="email-statis-wrap ">
                                <div class="email-round-nock">
                                    <input type="text" class="knob" value="0" data-rel="<?php echo ($NoOfNoneDisplaced/$ReportData['allchilds']) *100; ?>" data-linecap="round" data-width="130" data-bgcolor="#E4E4E4" data-fgcolor="#00c292" data-thickness=".10" data-readonly="true">
                                </div>
                                <div class="email-ctn-nock">
                                    <p>من سكان المنطقة</p>
                                </div>
                            </div>
							 <div class="email-statis-wrap ">
                                <div class="email-round-nock">
                                    <input type="text" class="knob" value="0" data-rel="<?php echo ($NoOfDisplaced/$ReportData['allchilds']) *100; ?>" data-linecap="round" data-width="130" data-bgcolor="#E4E4E4" data-fgcolor="#00c292" data-thickness=".10" data-readonly="true">
                                </div>
                                <div class="email-ctn-nock">
                                    <p>نازحين</p>
                                </div>
                            </div>
                            
                        </div>
                    </div>
					  </div>
                </div>
				  <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          عدد المستفيدين من كل نشاط
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div id="ExpCatchartdiv"  style="width: 100%;	height	: 500px;"></div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
			</div>
        </div>
    </div>
    <!-- End Sale Statistic area-->
    <!-- Start Email Statistic area-->
    
    <!-- End Email Statistic area-->
    <!-- Start Realtime sts area-->
    
    <!-- End Realtime sts area-->
    <!-- Start Footer area-->
    <div class="footer-copyright-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="footer-copy-right">
                        <p>Copyright © 2019 
. All rights reserved. <a href="https://colorlib.com">Agile Softnet Yemen</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
 <?php require_once("footer-links.php");  ?>
    <script src="js/charts//raphael.min.js"></script>
    <script src="js/charts/morris.min.js"></script>
	 <script src="js/charts/morris-data.js"></script>
   <script src="js/amcharts/amcharts.js"></script>
<script src="js/amcharts/pie.js"></script>
<script src="js/amcharts/serial.js"></script>
<script src="js/amcharts/gauge.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="js/amcharts/export.css" type="text/css" media="all" />
<script src="js/amcharts/light.js"></script>
<script src="js/amcharts/canvasjs.min.js"> </script>
  <script  src="js/TestIndex.js?v=1.2"></script>
