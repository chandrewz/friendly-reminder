<?php
	if (isset($_POST['action']) && $_POST['action'] == 'remind') {
		require_once('src/Database.php');
		$db = new Database();
		$db->connect();
		$db->addReminder($_POST['option'], $_POST['number'], $_POST['message'], $_POST['time']);
		echo 'A ' . $_POST['option'] . ' was scheduled for ' . $_POST['number'] . ' at ' . $_POST['time'];
	}
?>

<html>

	<head>
		<title>Friendly Reminder - An app to send you or your friends a reminder!</title>

		<!-- jQuery -->
		<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>

		<!-- Bootstrap -->
		<script src="assets/js/bootstrap.min.js"></script>
		<link href="assets/css/bootstrap.min.css" rel="stylesheet">

		<!-- Date Time Picker -->
		<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
		<link href="assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

		<!-- Custom assets for this template -->
		<link href="assets/css/main.css" rel="stylesheet">
		<link href="assets/css/font-awesome.min.css" rel="stylesheet">

	</head>

	<body>

		<div class="nav">
			<a href="index.html#hero" class="scroll">section one</a>
			<a href="index.html#networks" class="scroll">section three</a>
		</div>

		<section id="hero">
			<div class="hero-block">
				<h1>friendly reminder</h1>
				<h2>BETA</h2>
				<p>
					<i class="glyphicon glyphicon-phone"></i>
					<i class="glyphicon glyphicon-envelope"></i>
					<i class="glyphicon glyphicon-earphone"></i>
				</p>
				<p>
					Need a friendly reminder?
					<br/>
					Pick a time and receive a text, email, or phone call as your scheduled reminder :)
					<br/>
					Did we say friendly?
					<br/>
					Yes, you can remind yourself and even remind things for friends!
				</p>
			</div>
			<a href="index.html#networks" class="scroll"><span class="down-arrow"></span></a>
		</section>
	
		<section id="networks">
			<div>
				<h1>send a reminder</h1>
				<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
					<fieldset>
						<input name="action" value="remind" type="hidden"/>
						<div class="row">
							<div class="col-md-6 col-md-offset-3">
								<label class="control-label">Select Reminder Option (email not supported yet!)</label>
								<select name="option">
									<option value="text">Text</option>
									<option value="call">Call</option>
									<option value="email">Email</option>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-md-offset-3">
								<label class="control-label" for="number">Your Number</label>
								<input type="text" name="number" class="form-control" placeholder="Number / Email">
							</div>
						</div>
						<div class="row">
							<div class="col-md-4 col-md-offset-4">
							<div class="input-group">
								<label class="control-label" for="time">Pick a Time</label>
								<input name="time" type="text" value="2014-03-01 12:00:00" readonly class="form_datetime form-control" size="40">
								<script type="text/javascript">$(".form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii'});</script> 
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
			</div>
		</section>

		<!-- Placed at the end of the document so the pages load faster -->
		<script src="assets/js/jribbble.js"></script>
		<script src="assets/js/site-ck.js"></script>
	</body>

</html>