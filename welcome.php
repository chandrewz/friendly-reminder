<?php

if (!$_SESSION['user'])
	header('location: login.php')

?>
<html>

<body>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<fieldset>
		<input name="action" value="remind" type="hidden"/>
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
		<script>
			$.ajax(
				type: 'GET',
				url: 'friends-api.php?user=' + <?php echo $_SESSION['user'] ?>,
				dataType: 'text/html'
			);
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