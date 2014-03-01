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

	/*$reminder = reminder('text', '7133677805', 'Yo yo', $date);
	if ($reminder) echo "$reminder<br/>";
	else echo 'Reminder not working';*/

	$select = select();
	if ($reminder) {
		while ($row = pg_fetch_row($select)) {
			echo "Author: $row[0]  E-mail: $row[1]";
			echo "$row<br />\n";
		}
	}
	else echo 'Select not working';
?>