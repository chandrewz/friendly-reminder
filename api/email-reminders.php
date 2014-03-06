<?php

/**
 * Given 2 users, return their friendly reminder email history.
 */

header("Content-Type:text/plain");

if (isset($_GET['from']) && isset($_GET['to'])) {
	require_once('../src/Contactor.php');
	$contactor = new Contactor();
	$results = $contactor->getFriendlyReminderEmails($_GET['from'], $_GET['to']);
	echo $results;
}
