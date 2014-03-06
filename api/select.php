<?php

header("Content-Type:text/plain");

if (isset($_GET['table'])) {
	require_once('../src/Database.php');
	$db = new Database();
	$db->connect();
	$results = $db->select($_GET['table']);
	echo json_encode(pg_fetch_all($results));
}
