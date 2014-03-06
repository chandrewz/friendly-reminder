<?php

session_start();

if (!$_SESSION['user']) header('location: login.php');

require_once('src/Database.php');
require_once('src/Contactor.php');

$contactor = new Contactor();
$db = new Database();
$db->connect();

$user = $_SESSION['user'];
//$user = 'chandrew';

$obj = pg_fetch_object($db->getUserInfo($user));
$userEmail = $obj->{'email'};
$accountId = $contactor->getEmailId($userEmail);

$result = $db->getFriends($user);

//echo $accountId;


while ($row = pg_fetch_object($result)) {
	//echo $row->{'friend_username'} + '\n';
	$friendUsername = $row->{'friend_username'};
	echo $friendUsername . " ";
	$obj = pg_fetch_object($db->getUserInfo($friendUsername));

	$friendEmail = $obj->{'email'};
	echo "($friendEmail): ";

	if (!empty($friendEmail)) {
		$args = array('to'=>$friendEmail, 'subject'=>'/friendly-reminder/', 'limit'=>20);
		$r = $contactor->contextIO->listMessages($accountId, $args);
		foreach ($r->getData() as $message) {
			echo $message['subject'] . ", ";
		}
	}
	echo "\n<br/>";
}