<?php

header("Content-Type:text/plain");

if (isset($_GET['user'])) {
	require_once('../src/Database.php');
	$db = new Database();
	$db->connect();
	$friends = $db->getFriends($_GET['user']);
	echo json_encode(pg_fetch_all($friends));
}
