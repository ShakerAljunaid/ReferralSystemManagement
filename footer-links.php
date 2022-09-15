<?php require_once('pending-cases.php');require_once('pending-diagonist-cases.php');require_once('pending-Iom-cases.php'); ?>
    <!-- wow JS
		============================================ -->
    <script src="js/wow.min.js"></script>
    <!-- price-slider JS
		============================================ -->
    <script src="js/jquery-price-slider.js"></script>
    <!-- owl.carousel JS
		============================================ -->
    <script src="js/owl.carousel.min.js"></script>
    <!-- scrollUp JS
		============================================ -->
    <script src="js/jquery.scrollUp.min.js"></script>
    <!-- meanmenu JS
		============================================ -->
    <script src="js/meanmenu/jquery.meanmenu.js"></script>
    <!-- counterup JS
		============================================ -->
    <script src="js/counterup/jquery.counterup.min.js"></script>
    <script src="js/counterup/waypoints.min.js"></script>
    <script src="js/counterup/counterup-active.js"></script>
    <!-- mCustomScrollbar JS
		============================================ -->
    <script src="js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- sparkline JS
		============================================ -->
    <script src="js/sparkline/jquery.sparkline.min.js"></script>
    <script src="js/sparkline/sparkline-active.js"></script>
    <!-- flot JS
		============================================ -->
    <script src="js/flot/jquery.flot.js"></script>
    <script src="js/flot/jquery.flot.resize.js"></script>
    <script src="js/flot/flot-active.js"></script>
    <!-- knob JS
		============================================ -->
    <script src="js/knob/jquery.knob.js"></script>
    <script src="js/knob/jquery.appear.js"></script>
    <script src="js/knob/knob-active.js"></script>
    <!--  wave JS
		============================================ -->
    <script src="js/wave/waves.min.js"></script>
    <script src="js/wave/wave-active.js"></script>
    <!--  Chat JS
		============================================ -->
    <script src="js/chat/jquery.chat.js"></script>
    <!-- Login JS
		============================================ -->
    <script src="js/login/login-action.js"></script>
    <!--  todo JS
		============================================ -->
    <script src="js/todo/jquery.todo.js"></script>
    <!-- plugins JS
		============================================ -->
    <script src="js/plugins.js"></script>
    <!-- main JS
		============================================ -->
    <script src="js/main.js"></script>
	 <script src="js/mk-notifications.min.js"></script>
	 <script>$(document).ready(function() {
    /* MK Web Notification init */
    mkNotifications();
	$('#log_out').on('click',function(e){
		
		$(this).attr('href','login.php');
	});
});
function getWeek()
{
	let curr = new Date 
let week = []

for (let i = 1; i <= 7; i++) {
  let first = curr.getDate() - curr.getDay() + i 
  
  let day = new Date(curr.setDate(first)).toISOString().slice(0, 10)
  week.push(day)
}
return week;
}

function GFG_Fun() { 
let monthDates=[];
 var date = new Date(); 
 var month = date.getMonth() + 1; 
 var year = date.getFullYear(); 
 let NoOfMonthDays=new Date(year, month, 0).getDate(); ;

	let day = new Date(date.setDate(2)).toISOString().slice(0, 10)
	monthDates.push(day)
	day = new Date(date.setDate(NoOfMonthDays+1)).toISOString().slice(0, 10)
	monthDates.push(day)
return monthDates;
            } 
</script>

	
<script src='GrdExp/js/bootstrap-table.js'></script>
<script src='GrdExp/js/bootstrap-table-editable.js'></script>
<script src='GrdExp/js/bootstrap-table-export.js'></script>
<script src='GrdExp/js/tableExport.js'></script>
<script src='GrdExp/js/bootstrap-table-filter-control.js'></script>


	