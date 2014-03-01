<?php
	/**
	 * functions.php test runner
	 */
	require '../functions.php';

	// text works, but is annoying.
	//text('+17133677805', 'Hello!');

	date_default_timezone_set("America/Chicago");
	$date = date('Y-m-d H:i:s');
	echo "Current time: $date<br/>";

	$reminder = reminder('text', '7133677805', 'Yo yo', $date);
	if ($reminder) echo "$reminder<br/>";
	else echo 'Reminder not working';
	$select = select();
	if ($reminder) echo "$select<br/>";
	else echo 'Select not working';
?>