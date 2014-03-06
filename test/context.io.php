#!/usr/bin/php
<?php
// remove first line above if you're not running these examples through PHP CLI

include_once("../libs/context-io/class.contextio.php");

// see https://console.context.io/#settings to get your consumer key and consumer secret.
$contextIO = new ContextIO('8kppd9xb','YEj7wF0pwSF9XeyI');
$accountId = null;

// list your accounts
$args = array('email' => 'andrewsmail1@gmail.com');
$r = $contextIO->listAccounts($args);
/*foreach ($r->getData() as $account) {
	echo $account['id'] . "\t" . join(", ", $account['email_addresses']) . "\n";
	if (is_null($accountId)) {
		$accountId = $account['id'];
	}
}

if (is_null($accountId)) {
	die;
}*/

// EXAMPLE 1
// Print the subject line of the last 20 emails sent to with bill@widgets.com
/*$args = array('to'=>'chandrew@utexas.edu', 'limit'=>20);
echo "\nGetting last 20 messages exchanged with {$args['to']}\n";
$r = $contextIO->listMessages($accountId, $args);
foreach ($r->getData() as $message) {
	echo "Subject: ".$message['subject']."\n";
}

$args = array('to'=>'chandrew@utexas.edu', 'subject'=>'/reminder/', 'limit'=>20);
echo "\nGetting last 20 messages exchanged with {$args['to']}\n";
$r = $contextIO->listMessages($accountId, $args);
foreach ($r->getData() as $message) {
	echo "Subject: ".$message['subject']."\n";
}*/
$obj = $r->getRawResponse();
$json = json_decode($obj);
echo $json[0]->{'id'};

echo getFriendlyReminderEmails('andrewsmail1@gmail.com', 'chandrew@utexas.edu', $json[0]->{'id'});

echo "\nall examples finished\n";

function getFriendlyReminderEmails($from, $to, $accountId) {
	global $contextIO;
	$args = array('to'=>$to, 'subject'=>'/friendly-reminder/', 'limit'=>20);
	$r = $contextIO->listMessages($accountId, $args);
	return $r->getRawResponse();
}
?>
