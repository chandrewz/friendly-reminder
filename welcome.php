<?php

if (isset($_POST['action']) && $_POST['action'] == 'remind') {
	require_once('src/Database.php');
	$db = new Database();
	$db->connect();
	$friend = $db->getUser($_POST['friend']);
	$row = pg_fetch_object($friend);
	$db->addReminder($_POST['option'], $row->phone, $_POST['message'], $_POST['time']);
	echo 'A ' . $_POST['option'] . ' was scheduled for ' . $row->phone . ' at ' . $_POST['time'];
}

?>


<html>
	<head>
		<!-- jQuery -->
		<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>

		<!-- Bootstrap -->
		<script src="assets/js/bootstrap.min.js"></script>
		<link href="assets/css/bootstrap.min.css" rel="stylesheet">

		<!-- Date Time Picker -->
		<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
		<link href="assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
	</head>

	<body>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<fieldset>
				<input name="action" value="remind" type="hidden"/>
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<label class="control-label">Select Friend</label>
						<select id="friend-option" name="friend">
						</select>
					</div>
				</div>
				<script>
					$.ajax({
						type: 'GET',
						url: 'api/friend-api.php?user=' + <?php session_start(); echo $_SESSION['user']; ?>,
						dataType: 'json'
					}).done(function(data) {
						for (var i in data) {
							$( "#friend-option" ).append( "<option>" + data[i]['friend_username'] + "</option>" );
						}
					});
				</script>
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<label class="control-label">Select Reminder Option (email not supported yet!)</label>
						<select name="option">
							<option>Text</option>
							<option>Call</option>
							<option>Email</option>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4 col-md-offset-4">
					<div class="input-group">
						<label class="control-label" for="time">Pick a Time</label>
						<input name="time" type="text" value="2014-03-01 14:45:00" readonly class="form_datetime form-control" size="40">
						<script type="text/javascript">$(".form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii:ss'});</script> 
					</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 col-md-offset-4">
						<div class="input-group">
							<label class="control-label" for="message">Message</label>
							<textarea name="message" cols="40" rows="5" class="form-control" placeholder="Your reminder message to send."></textarea>
						</div>
					</div>
				</div>
				<input class="submit-button btn btn-inverse" type="submit" value="Send" />
			</fieldset>
		</form>

</body>

</html>