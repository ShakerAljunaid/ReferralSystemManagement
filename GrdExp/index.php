<!DOCTYPE html>
<?php
require ('dbconfig.php');
	$sql = 'select * from accountmessagesview  order by ID desc';
	$ReadMessage = $pdo->query($sql);
	
	?>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Bootstrap table filter,sorting,export</title>
  
  
  <link rel='stylesheet' href='css/bootstrap.min.css'>
<link rel='stylesheet' href='css/bootstrap-table.min.css'>
<link rel='stylesheet' href='css/bootstrap-editable.css'>

  <style>.HideColHeadOnMobile{display:none;
  visibility:hidden;} </style>
  
</head>

<body>

  <div class="container">
<h1>Bootstrap Table</h1>

<p>A table with third party integration  extension Filter control extension Data export</a> pour exporter</p>

<div id="toolbar">
		<select class="form-control">
				<option value="">Export Basic</option>
				<option value="all">Export All</option>
				<option value="selected">Export Selected</option>
		</select>
</div>

<table id="table" 
			 data-toggle="table"
			 data-search="true"
			 data-filter-control="true" 
			 data-show-export="true"
			 data-click-to-select="true"
			 data-toolbar="#toolbar"
       class="table-responsive">
	<thead>
		<tr>
			<th data-field="state" data-checkbox="true"></th>
			<th data-field="prenom" data-filter-control="input" data-sortable="true">First Name</th>
			<th data-field="date" data-filter-control="input" data-sortable="true">Date</th>
			<th data-field="examen" data-filter-control="input" data-sortable="true" >Examination</th>
			<th data-field="note" data-sortable="true"  style="display:none" >Note</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$counter=0;
	  while($MSG = $ReadMessage->fetch()){ ?>
	  
		<tr>
			<td class="bs-checkbox "><input data-index="<?php echo $counter; ?>" name="btSelectItem" type="checkbox"></td>
			<td><?php echo 'Noor'; ?></td>
			<td><?php echo $MSG['Message_title']; ?></td>
			<td><?php echo $MSG['Message_text']; ?></td>
			<td  style="display:none"><?php echo $MSG['Created_date']; ?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>
</div>
  <script src='js/jquery.min.js'></script>
<script src='js/bootstrap.min.js'></script>
<script src='js/bootstrap-table.js'></script>
<script src='js/bootstrap-table-editable.js'></script>
<script src='js/bootstrap-table-export.js'></script>
<script src='js/tableExport.js'></script>
<script src='js/bootstrap-table-filter-control.js'></script>

  

    <script  src="js/index.js"></script>




</body>

</html>
