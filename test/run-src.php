<?php
	require '../src/Contactor.php';
	require '../src/Database.php';

	echo 'Begin text test.';
	$contactor = new Contactor();
	$contactor->text('7133677805', 'Please work!');
	echo 'Text sent<br/>';

	$db = new Database();
	echo $db->pgConnectionString();
	$connected = $db->connect();
	if ($connected) {
		echo 'Connected!<br/>';
		date_default_timezone_set("America/Chicago");
		$date = date('Y-m-d H:i:s');
		echo "Current time: $date";
		$added = $db->addReminder('text', '7133677805', 'addReminder message', $date);
		if ($added) echo 'Reminder added<br/>';
		else echo 'addReminder failed<br/>';

		$ready = $db->getReadyReminders();
		if ($ready) {
			echo print_r(pg_fetch_array($ready, NULL, PGSQL_ASSOC));
		} else echo 'getReadyReminders() failed<br/>';
	}
	else echo 'Not connected :(<br/>';