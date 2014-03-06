<?php

session_start();

if ($_SESSION['user'] && isset($_POST['action']) && $_POST['action'] == 'remind') {
	require_once('src/Database.php');
	$db = new Database();
	$db->connect();
	$friend = $db->getUser($_POST['friend']);
	$row = pg_fetch_object($friend);
	$db->addReminder($_POST['option'], $row->phone, $_POST['message'], $_POST['time']);
	echo 'A ' . $_POST['option'] . ' was scheduled for ' . $row->phone . ' at ' . $_POST['time'];
} else {
	header('location: login.php');
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
		<style>
			html {
				display: table;
				margin: auto;
			}
			html, body {
				height: 100%;
			}
			body {
				font-size: 2em;
				background-color: rgb(126, 196, 69);
				display: table-cell;
				vertical-align: middle;
			}
		</style>
	</head>

	<body>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<fieldset>
				<div class="input-group">
					<input name="action" value="remind" type="hidden"/>
					<label class="control-label">Select Friend</label>
					<select id="friend-option" name="friend">
					</select>
					<script>
						$.ajax({
							type: 'GET',
							url: 'api/friend-api.php?user=<?php session_start(); echo $_SESSION['user']; ?>',
							dataType: 'json'
						}).done(function(data) {
							for (var i in data) {
								$( "#friend-option" ).append( "<option>" + data[i]['friend_username'] + "</option>" );
							}
						});
					</script>
				</div>
				<div class="input-group">
					<label class="control-label">Select Reminder Option (email not supported yet!)</label>
					<select name="option">
						<option value="text">Text</option>
						<option value="call">Call</option>
						<option value="email">Email</option>
					</select>
				</div>
				<div class="input-group">
					<label class="control-label" for="time">Pick a Time</label>
					<input name="time" type="text" value="2014-03-01 14:45:00" readonly class="form_datetime form-control" size="40">
					<script type="text/javascript">$(".form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii:ss'});</script> 
				</div>
				<div class="input-group">
					<label class="control-label" for="message">Message</label>
					<textarea name="message" cols="40" rows="5" class="form-control" placeholder="Your reminder message to send."></textarea>
				</div>
				<input class="submit-button btn btn-inverse" type="submit" value="Send" />
			</fieldset>
		</form>

</body>

</html>