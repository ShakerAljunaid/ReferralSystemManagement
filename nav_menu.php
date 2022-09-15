<?php 
if(isset($_SESSION["user_type"]))
{$UserType=$_SESSION["user_type"];
 $UserId=$_SESSION["user_id"];
}
 echo '<script>var UserId='.$UserId.';//alert(UserId); </script>'; 

?>
    <div class="header-top-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="header-top-menu">
                        <ul class="nav navbar-nav notika-top-nav">
						     <li class="nav-item dropdown">
                                <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><span><i class="notika-icon notika-close"><?php echo $_SESSION["user_name"]; ?></i></span></a>
                                <div role="menu" class="dropdown-menu search-dd animated flipInX">
                                    <div class="notika-icon notika-close">
                                      <a id="log_out" >  تسجيل الخروج</i></a>
                                       
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><span><i class="notika-icon notika-search"></i></span></a>
                                <div role="menu" class="dropdown-menu search-dd animated flipInX">
                                    <div class="search-input">
                                        <i class="notika-icon notika-left-arrow"></i>
                                        <input type="text" />
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown hidden">
                                <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><span><i class="notika-icon notika-mail"></i></span></a>
                                <div role="menu" class="dropdown-menu message-dd animated zoomIn">
                                    <div class="hd-mg-tt">
                                        <h2>Messages</h2>
                                    </div>
                                    <div class="hd-message-info" >
                                        <a href="#">
                                            <div class="hd-message-sn">
                                                <div class="hd-message-img">
                                                    <img src="img/post/1.jpg" alt="" />
                                                </div>
                                                <div class="hd-mg-ctn">
                                                    <h3>David Belle</h3>
                                                    <p>Cum sociis natoque penatibus et magnis dis parturient montes</p>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#">
                                            <div class="hd-message-sn">
                                                <div class="hd-message-img">
                                                    <img src="img/post/2.jpg" alt="" />
                                                </div>
                                                <div class="hd-mg-ctn">
                                                    <h3>Jonathan Morris</h3>
                                                    <p>Cum sociis natoque penatibus et magnis dis parturient montes</p>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#">
                                            <div class="hd-message-sn">
                                                <div class="hd-message-img">
                                                    <img src="img/post/4.jpg" alt="" />
                                                </div>
                                                <div class="hd-mg-ctn">
                                                    <h3>Fredric Mitchell</h3>
                                                    <p>Cum sociis natoque penatibus et magnis dis parturient montes</p>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#">
                                            <div class="hd-message-sn">
                                                <div class="hd-message-img">
                                                    <img src="img/post/1.jpg" alt="" />
                                                </div>
                                                <div class="hd-mg-ctn">
                                                    <h3>David Belle</h3>
                                                    <p>Cum sociis natoque penatibus et magnis dis parturient montes</p>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#">
                                            <div class="hd-message-sn">
                                                <div class="hd-message-img">
                                                    <img src="img/post/2.jpg" alt="" />
                                                </div>
                                                <div class="hd-mg-ctn">
                                                    <h3>Glenn Jecobs</h3>
                                                    <p>Cum sociis natoque penatibus et magnis dis parturient montes</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="hd-mg-va">
                                        <a href="#">View All</a>
                                    </div>
                                </div>
                            </li>
							<?php 
							 if($UserType==524 || $UserType==436 ){
								 ?>
								  <li class="nav-item nc-al "><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><span><i class="notika-icon notika-alarm"></i></span><div class="spinner4 spinner-4"></div><div class="ntd-ctn"><span id='NoOfPendingIomAnalysisCases'>3</span></div></a>
                               <div role="menu" class="dropdown-menu message-dd chat-dd animated zoomIn pendingChildrenCases" >
                                    <div class="hd-mg-tt">
                                        <h2>حالات الIOM المعلقة</h2>
                                    </div>
                                    <div class="search-people hidden">
                                        <i class="notika-icon notika-left-arrow"></i>
                                        <input type="text" placeholder="Search People" />
                                    </div>
                                    <div class="hd-message-info"  >
                                     <table class="table IomAnalysisPendingChildrenCases"  data-search="true" 
					data-click-to-select="true"
			           id="PendingIomAnalysisChildrenCases">
										<thead>
                                                <tr>
												
													<th  data-formatter="IomCaseChildNameFormatter"   ></th>
                                                   
													
												</tr>
                                            </thead>
                                             <tbody >
											
											 </tbody>
                                        </table>
                                    </div>
                                    <div class="hd-mg-va">
                                        <a href="#" id="btnShowAllPendingIomAnalysisModal">رؤية الكل</a>
                                    </div>
                                </div>
                            </li>
							<?php 
							 }
							 if($UserType==433 || $UserType==436 ){
								 ?>
                            <li class="nav-item nc-al "><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><span><i class="notika-icon notika-mail"></i></span><div class="spinner4 spinner-4"></div><div class="ntd-ctn"><span id='NoOfPendingDiagnoseCases'>3</span></div></a>
                               <div role="menu" class="dropdown-menu message-dd chat-dd animated zoomIn pendingChildrenCases" >
                                    <div class="hd-mg-tt">
                                        <h2>حالات معلقة للتشخيص</h2>
                                    </div>
                                    <div class="search-people hidden">
                                        <i class="notika-icon notika-left-arrow"></i>
                                        <input type="text" placeholder="Search People" />
                                    </div>
                                    <div class="hd-message-info"  >
                                     <table class="table DiagnosePendingChildrenCases"  data-search="true" 
					data-click-to-select="true"
			           id="PendingDiagnoseChildrenCases1">
										<thead>
                                                <tr>
												
													<th  data-formatter="ChildNameFormatter"   ></th>
                                                   
													
												</tr>
                                            </thead>
                                             <tbody >
											
											 </tbody>
                                        </table>
                                    </div>
                                    <div class="hd-mg-va">
                                        <a href="#" id="btnShowAllPendingDiagnoseModal">رؤية الكل</a>
                                    </div>
                                </div>
                            </li>
							
							 <?php } ?>
                            <li class="nav-item hidden"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><span><i class="notika-icon notika-menus"></i></span><div class="spinner4 spinner-4"></div><div class="ntd-ctn"><span>2</span></div></a>
                                <div role="menu" class="dropdown-menu message-dd task-dd animated zoomIn">
                                    <div class="hd-mg-tt">
                                        <h2>Tasks</h2>
                                    </div>
                                    <div class="hd-message-info hd-task-info">
                                        <div class="skill">
                                            <div class="progress">
                                                <div class="lead-content">
                                                    <p>HTML5 Validation Report</p>
                                                </div>
                                                <div class="progress-bar wow fadeInLeft" data-progress="95%" style="width: 95%;" data-wow-duration="1.5s" data-wow-delay="1.2s"> <span>95%</span>
                                                </div>
                                            </div>
                                            <div class="progress">
                                                <div class="lead-content">
                                                    <p>Google Chrome Extension</p>
                                                </div>
                                                <div class="progress-bar wow fadeInLeft" data-progress="85%" style="width: 85%;" data-wow-duration="1.5s" data-wow-delay="1.2s"><span>85%</span> </div>
                                            </div>
                                            <div class="progress">
                                                <div class="lead-content">
                                                    <p>Social Internet Projects</p>
                                                </div>
                                                <div class="progress-bar wow fadeInLeft" data-progress="93%" style="width: 93%;" data-wow-duration="1.5s" data-wow-delay="1.2s"><span>93%</span> </div>
                                            </div>
                                            <div class="progress">
                                                <div class="lead-content">
                                                    <p>Bootstrap Admin Template</p>
                                                </div>
                                                <div class="progress-bar wow fadeInLeft" data-progress="93%" style="width: 93%;" data-wow-duration="1.5s" data-wow-delay="1.2s"><span>93%</span> </div>
                                            </div>
                                            <div class="progress progress-bt">
                                                <div class="lead-content">
                                                    <p>Youtube Client App</p>
                                                </div>
                                                <div class="progress-bar wow fadeInLeft" data-progress="93%" style="width: 93%;" data-wow-duration="1.5s" data-wow-delay="1.2s"><span>93%</span> </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="hd-mg-va">
                                        <a href="#">View All</a>
                                    </div>
                                </div>
                            </li>
							<?php 
							 if($UserType==434 || $UserType==436 ){
								 ?>
                            <li class="nav-item"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><span><i class="notika-icon notika-chat"></i></span><div class="spinner4 spinner-4"></div><div class="ntd-ctn"><span id="NoOfPendingCases">2</span></div></a>
                                <div role="menu" class="dropdown-menu message-dd chat-dd animated zoomIn pendingChildrenCases" >
                                    <div class="hd-mg-tt">
                                        <h2>الحالات المعلقة</h2>
                                    </div>
                                    <div class="search-people hidden">
                                        <i class="notika-icon notika-left-arrow"></i>
                                        <input type="text" placeholder="Search People" />
                                    </div>
                                    <div class="hd-message-info"  >
                                     <table class="table pendingChildrenCases"  data-search="true" 
					data-click-to-select="true"
			           id="pendingChildrenCases1">
										<thead>
                                                <tr>
												
													<th  data-formatter="CaseChildNameFormatter"   ></th>
                                                   
													
												</tr>
                                            </thead>
                                             <tbody >
											
											 </tbody>
                                        </table>
                                    </div>
                                    <div class="hd-mg-va">
                                        <a href="#" id="btnShowAllpendingModal">رؤية الكل</a>
                                    </div>
                                </div>
                            </li>
							 <?php } ?>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="logo-area">
                        <a href="#"><img src="img/logo/logo.png" alt="" /></a>
                    </div>
                </div>
                
                
            </div>
        </div>
    </div>
    <!-- End Header Top Area -->
    <!-- Mobile Menu start -->
    <div class="mobile-menu-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="mobile-menu">
                        <nav id="dropdown">
                            <ul class="mobile-menu-nav">
                                <li><a data-toggle="collapse" data-target="#Charts" href="#">الرئسية</a>
                                    <ul class="collapse dropdown-header-top">
                                        <li><a href="index.html">تسجيل طفل جديد</a></li>
                                        <li><a href="index-2.html">تسجيل خدمة جديدة</a></li>
                                        <li><a href="index-3.html">تسجيل مختص جديد</a></li>
                                        <li><a href="index-4.html">تسجيل مستخدم جديد</a></li>
                                        <li><a href="analytics.html" class="hidden">Analytics</a></li>
                                        <li><a href="widgets.html" class="hidden">Widgets</a></li>
                                    </ul>
                                </li>
                                <li><a data-toggle="collapse" data-target="#demoevent" href="#">Email</a>
                                    <ul id="demoevent" class="collapse dropdown-header-top">
                                        <li><a href="inbox.html">Inbox</a></li>
                                        <li><a href="view-email.html">View Email</a></li>
                                        <li><a href="compose-email.html">Compose Email</a></li>
                                    </ul>
                                </li>
                                <li><a data-toggle="collapse" data-target="#democrou" href="#">Interface</a>
                                    <ul id="democrou" class="collapse dropdown-header-top">
                                        <li><a href="animations.html">Animations</a></li>
                                        <li><a href="google-map.html">Google Map</a></li>
                                        <li><a href="data-map.html">Data Maps</a></li>
                                        <li><a href="code-editor.html">Code Editor</a></li>
                                        <li><a href="image-cropper.html">Images Cropper</a></li>
                                        <li><a href="wizard.html">Wizard</a></li>
                                    </ul>
                                </li>
                                <li><a data-toggle="collapse" data-target="#demolibra" href="#">Charts</a>
                                    <ul id="demolibra" class="collapse dropdown-header-top">
                                        <li><a href="flot-charts.html">Flot Charts</a></li>
                                        <li><a href="bar-charts.html">Bar Charts</a></li>
                                        <li><a href="line-charts.html">Line Charts</a></li>
                                        <li><a href="area-charts.html">Area Charts</a></li>
                                    </ul>
                                </li>
                                <li><a data-toggle="collapse" data-target="#demodepart" href="#">Tables</a>
                                    <ul id="demodepart" class="collapse dropdown-header-top">
                                        <li><a href="normal-table.html">Normal Table</a></li>
                                        <li><a href="data-table.html">Data Table</a></li>
                                    </ul>
                                </li>
                                <li><a data-toggle="collapse" data-target="#demo" href="#">Forms</a>
                                    <ul id="demo" class="collapse dropdown-header-top">
                                        <li><a href="form-elements.html">Form Elements</a></li>
                                        <li><a href="form-components.html">Form Components</a></li>
                                        <li><a href="form-examples.html">Form Examples</a></li>
                                    </ul>
                                </li>
                                <li><a data-toggle="collapse" data-target="#Miscellaneousmob" href="#">App views</a>
                                    <ul id="Miscellaneousmob" class="collapse dropdown-header-top">
                                        <li><a href="notification.html">Notifications</a>
                                        </li>
                                        <li><a href="alert.html">Alerts</a>
                                        </li>
                                        <li><a href="modals.html">Modals</a>
                                        </li>
                                        <li><a href="buttons.html">Buttons</a>
                                        </li>
                                        <li><a href="tabs.html">Tabs</a>
                                        </li>
                                        <li><a href="accordion.html">Accordion</a>
                                        </li>
                                        <li><a href="dialog.html">Dialogs</a>
                                        </li>
                                        <li><a href="popovers.html">Popovers</a>
                                        </li>
                                        <li><a href="tooltips.html">Tooltips</a>
                                        </li>
                                        <li><a href="dropdown.html">Dropdowns</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a data-toggle="collapse" data-target="#Pagemob" href="#">Pages</a>
                                    <ul id="Pagemob" class="collapse dropdown-header-top">
                                        <li><a href="contact.html">Contact</a>
                                        </li>
                                        <li><a href="invoice.html">Invoice</a>
                                        </li>
                                        <li><a href="typography.html">Typography</a>
                                        </li>
                                        <li><a href="color.html">Color</a>
                                        </li>
                                        <li><a href="login-register.html">Login Register</a>
                                        </li>
                                        <li><a href="404.html">404 Page</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Mobile Menu end -->
    <!-- Main Menu area start-->
    <div class="main-menu-area mg-tb-40">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">
                          <li ><a data-toggle="tab" href="#Home"><i class="notika-icon notika-house"></i> الرئيسية</a>
                        </li>
						  <?php  if($UserType==435 || $UserType==432  || $UserType==436 ){ ?>
                        <li><a data-toggle="tab" href="#mailbox"><i class="notika-icon notika-mail"></i>الحالات </a>
                        </li><?php } ?>
						<?php  if($UserType==434 || $UserType==436 || $UserType==433 || $UserType==524){ ?> 
                        <li><a data-toggle="tab" href="#Interface"><i class="notika-icon notika-edit"></i>التحليل </a>
                        </li><?php } ?>
						<?php  if($UserType==434 || $UserType==436 ){ ?> 
                        <li><a data-toggle="tab" href="#Charts"><i class="notika-icon notika-bar-chart"></i> الخدمات</a>
                        </li><?php } ?>
						<?php  if($UserType==442 || $UserType==436 || $UserType==433  || $UserType==523 || $UserType==524){ ?> 
                        <li><a data-toggle="tab" href="#Tables"><i class="notika-icon notika-windows"></i> الانشطة اليومية</a>
                        </li><?php } ?>
                          <?php  if($UserType==435 || $UserType==436 ){ ?> 
						<li><a data-toggle="tab" href="#Forms" class="active"><i class="notika-icon notika-form"></i> الأدلة</a>
						  </li><?php } ?>
                        <li class="hidden"><a data-toggle="tab" href="#Appviews"><i class="notika-icon notika-app"></i> App views</a>
                        </li>
                        <li class="hidden" ><a data-toggle="tab" href="#Page"><i class="notika-icon notika-support"></i> Pages</a>
                        </li>
                    </ul>
					<div class="tab-content custom-menu-content">
					   
							
                        <div id="Home" class="tab-pane in notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="index.php">اللوحة الرئيسية</a>
                                </li>
								 <li><a href="statistics_report.php">تقارير عامة</a>
                                </li>
                                
                            </ul>
                        </div>
						 <?php  if($UserType==435 || $UserType==436 || $UserType==432 ){
								 ?>
							
                        <div id="mailbox" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="new-registrant.php">حالة جديدة</a>
                                </li>
                                <li><a href="child-data-view.php">قائمة الحالات</a>
                                </li>
								 <li><a href="child_registrant_print_frm.php">طباعة مستند التسجيل</a>
                                </li>
								
								<?php if($UserType==436) { ?>
								 <li><a href="Closed_cases.php">طلبات إغلاق الحالات</a>
                                </li>
								 <li><a href="Reopen_closed_case.php">الطلبات المغلقة</a>
                                </li>
								 <li><a href="latest_report_4IOM.php">تقرير الـIOM</a>
                                </li>
								<?php } ?>
                            </ul>
                        </div>
						 <?php } ?>
                        <div id="Interface" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
							<?php  if($UserType==433 || $UserType==436 ){ ?> 
							 <li><a href="pending-diagonist-form.php">التشخيصات المعلقة</a>
                                </li>
                                <li><a href="assigned-diagnose-form.php">التشخيصات المستلمة</a>
                                </li>
								 <li><a href="closed-diagnose-form.php">التشخيصات المغلقة</a>
                                </li>
						   <?php } ?>
						   <?php  if($UserType==434 || $UserType==436 ){ ?> 
                                <li><a href="pending-cases-form.php">التحليلات المعلقة</a>
                                </li>
                                <li><a href="assigned-cases-form.php">التحليلات المستلمة</a>
                                </li>
								 <li><a href="external_refferal_report.php">الإحالات الخارجية</a>
                                </li>
							  <?php } ?>
							  <?php  if($UserType==524 || $UserType==436 ){ ?> 
                                <li><a href="pending-IomAnalysis-form.php">تحليلات الIOM المعلقة</a>
                                </li>
                                <li><a href="assigned-iomAnalysis-form.php">تحليلات الIOM المستلمة</a>
                                </li>
							  <?php } ?>
                            </ul>
                        </div>
						 <?php  if($UserType==434 || $UserType==436 ){ ?> 
                        <div id="Charts" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="child_service.php">تقديم خدمة</a>
                                </li>
								  <li><a href="child_service_report.php">تقرير الخدمات</a>
                                </li>
                            </ul>
                        </div>
						  <?php } ?>
						   <?php  if($UserType==442 || $UserType==436  || $UserType==433 || $UserType==523  || $UserType==524  ){ ?> 
                        <div id="Tables" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
							<?php if($UserType!=524){?>
							<li><a href="child_service-activities.php">مراقبة الحالات</a><?php } ?>
                                </li>
								 <li><a href="child_service_activity_report.php">تقرير الأنشطة</a>
                                </li>
                            </ul>
                           </div>
						  <?php } ?>
						  <?php  if($UserType==435 || $UserType==436 ){ ?> 
                        <div id="Forms" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
							 <li><a href="Behavior_data.php">التشخيصات المبدائية</a>
                                <li><a href="Service_data.php">الخدمات</a>
                                </li>
                                <li><a href="service_activite_data.php">الانشطة</a>
                                </li>
                                <li><a href="agency_data.php">الجهات الخارجية</a>
                                </li>
								<li><a href="agencyReferralPerson_data.php">مختصين الجهات الخارجية</a>
                                </li>
								<li><a href="many_list_data.php?TypeId=25">مصدر الطفل</a>
                                </li>
								<li><a href="many_list_data.php?TypeId=26">الجنسيات</a>
                                </li>
								<li><a href="many_list_data.php?TypeId=27">انواع الإعاقات</a>
                                </li>
								<li><a href="users_data.php">المستخدمين</a>
                                </li>
                            </ul>
                        </div>
						<?php } ?>
                        <div id="Appviews" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="notification.html">Notifications</a>
                                </li>
                                <li><a href="alert.html">Alerts</a>
                                </li>
                                <li><a href="modals.html">Modals</a>
                                </li>
                                <li><a href="buttons.html">Buttons</a>
                                </li>
                                <li><a href="tabs.html">Tabs</a>
                                </li>
                                <li><a href="accordion.html">Accordion</a>
                                </li>
                                <li><a href="dialog.html">Dialogs</a>
                                </li>
                                <li><a href="popovers.html">Popovers</a>
                                </li>
                                <li><a href="tooltips.html">Tooltips</a>
                                </li>
                                <li><a href="dropdown.html">Dropdowns</a>
                                </li>
                            </ul>
                        </div>
                        <div id="Page" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="contact.html">Contact</a>
                                </li>
                                <li><a href="invoice.html">Invoice</a>
                                </li>
                                <li><a href="typography.html">Typography</a>
                                </li>
                                <li><a href="color.html">Color</a>
                                </li>
                                <li><a href="login-register.html">Login Register</a>
                                </li>
                                <li><a href="404.html">404 Page</a>
                                </li>
                            </ul>
                        </div>
                    </div>
              
                             </div>
            </div>
        </div>
    </div>
    <!-- Main Menu area End-->

	<!-- Breadcomb area End-->
	
       