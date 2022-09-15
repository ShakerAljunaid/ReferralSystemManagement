<?php

	$sql = 'SELECT *, (male+female) as allchilds, (pending+recived+external+noneed+internal) AS Allcases from child_gender_summary JOIN case_status_summary;';
	$ReportData = $pdo->query($sql)->fetchAll();
	
	$sql = 'SELECT COUNT(ID) AS count, Created_date FROM childcase GROUP BY Created_date;';
	$DateReportData = $pdo->query($sql)->fetchAll();
	
	$sql = 'SELECT * FROM child_governate_summary;';
	$GovernateReportData = $pdo->query($sql)->fetchAll();
	
	echo '<script> var RegAllAttachment='.json_encode($ReportData).'; var JsRegDate='.json_encode($DateReportData).'; var regions='.json_encode($GovernateReportData).'; </script>';
?>