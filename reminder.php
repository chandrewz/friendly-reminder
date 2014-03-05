<?php

require 'src/Contactor.php';
require 'src/Database.php';

$contactor = new Contactor();
$db = new Database();
$connected = $db->connect();

if ($connected) {

	echo "Connected to database!\n";
	$reminders = pg_fetch_all($db->getReadyReminders());

	if ($reminders) {

		echo "We have reminders to send\n";

		foreach ($reminders as $remind) {
			if ($remind['reminder_type'] == 'text') {
				$contactor->text($remind['reminder_to'], $remind['reminder_message']);
				echo "Sent text id " . $remind['reminder_id'] . " to " . $remind['reminder_to'] . " with " . $remind['reminder_message'] . "\n";
			}
		}

		$db->updateSentReminders($reminders);

	} else {
		echo "No reminders!\n";
	}

} else {
	echo "Connection to database failed :(\n";
}