<?php
	if (isset($_POST['action']) && $_POST['action'] == 'text') {
		require 'functions.php';
		text($_POST['number'], $_POST['message']);
	}
?>

<html>

	<head>
		<title>Friendly Reminder - An app to send you or your friends a reminder!</title>
	</head>

	<body>
		<div>
			<h1>Send a Text</h1>
			<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<input name="action" value="text" type="hidden"/>
				Phone Number <input type="text" name="number"/>
				Message <textarea name="message" cols="40" rows="5"></textarea>
				<input class="submit-button" type="submit" value="Send" />
			</form>
		</div>
	</body>

</html>