<?php
	require_once(realpath(dirname(__FILE__) . '/../src/Contactor.php'));
	require_once(realpath(dirname(__FILE__) . '/../src/Database.php'));

	/*
	echo "Begin text test.\n<br/>";
	$contactor = new Contactor();
	$contactor->text('7133677805', 'Please work!');
	echo "Text sent\n<br/>";

	$contactor->call('7133677805', 'Hello');
	*/

	$db = new Database();
	echo $db->pgConnectionString();
	$connected = $db->connect();
	if ($connected) {
		echo "Connected!\n<br/>";
		date_default_timezone_set("America/Chicago");
		$date = date('Y-m-d H:i:s');
		echo "Current time: $date\n<br/>";

		$added = $db->addReminder('text', '7133677805', 'addReminder message', $date);
		if ($added) echo "Reminder added\n<br/>";
		else echo "addReminder failed\n<br/>";

		$ready = $db->getReadyReminders();
		if ($ready) {
			echo print_r(pg_fetch_all($ready));
		} else echo "getReadyReminders() failed\n<br/>";

		$db->addFriend("chandrew", "jlin");
		echo print_r(pg_fetch_all($db->getFriends("chandrew")));
	}
	else echo "Not connected :(\n<br/>";