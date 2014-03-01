<?php
	/**
	 * functions.php test runner
	 */
	require '../functions.php';

	// text works, but is annoying.
	//text('+17133677805', 'Hello!');

	echo '<br/>Connection string: ' + pg_connection_string() + '<br/>';

	echo 'time: ' + date("Y-m-d H:i:s",time()) + '<br/>';

	/*$reminder = reminder('text', '7133677805', 'Yo yo', );
	if ($reminder) echo $reminder;
	else echo 'Reminder not working';*/
?>