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
	}
	else echo 'Not connected :(<br/>';