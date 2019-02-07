<link rel="stylesheet" href="https://resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../css/clientForm.css">
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>

<script>
	$(function() {
		$("#startDate").value();
	});
</script>
<div class="row">
	<i class="expensicons expensicons-sm expensicons-per-diem"></i>

	<div class="startDate col-sm-12 col-md-6 filter-input">
		<div class="input-group">
			<span class="input-group-addon">From</span>
			<input type="text" id="startDate" name="startDate" class="calendar calendarMedium fullWidth form-control hasDatepicker" value="2019-02-07" autocomplete="off">
		</div>
	</div>

	<div class="endDate col-sm-12 col-md-6 filter-input"><div class="input-group"><span class="input-group-addon">To</span><input type="text" id="endDate" name="endDate" class="calendar calendarMedium fullWidth form-control hasDatepicker" value="2019-02-07" autocomplete="off"></div>
	</div>
</div>