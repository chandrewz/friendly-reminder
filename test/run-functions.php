<?php
	/**
	 * functions.php test runner
	 */
	require '../functions.php';

	// text works, but is annoying.
	//text('+17133677805', 'Hello!');

	date_default_timezone_set("America/Chicago");
	$date = date('Y-m-d H:i:s');
	echo "time: $date<br/>";

	$reminder = reminder('text', '7133677805', 'Yo yo', $date);
	if ($reminder) echo $reminder;
	else echo 'Reminder not working';
?>