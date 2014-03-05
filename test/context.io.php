#!/usr/bin/php
<?php
// remove first line above if you're not running these examples through PHP CLI

include_once("../libs/context-io/class.contextio.php");

// see https://console.context.io/#settings to get your consumer key and consumer secret.
$contextIO = new ContextIO('8kppd9xb','YEj7wF0pwSF9XeyI');
$accountId = null;

// list your accounts
$r = $contextIO->listAccounts();
foreach ($r->getData() as $account) {
	echo $account['id'] . "\t" . join(", ", $account['email_addresses']) . "\n";
	if (is_null($accountId)) {
		$accountId = $account['id'];
	}
}

if (is_null($accountId)) {
	die;
}

// EXAMPLE 1
// Print the subject line of the last 20 emails sent to with bill@widgets.com
$args = array('to'=>'chandrew@utexas.edu', 'limit'=>20);
echo "\nGetting last 20 messages exchanged with {$args['to']}\n";
$r = $contextIO->listMessages($accountId, $args);
foreach ($r->getData() as $message) {
	echo "Subject: ".$message['subject']."\n";
}

$params = array(
	'rcpt' => 'chandrew@utexas.edu',
	'message' => 'HELLO');
$contextIO->sendMessage($accountId, $params);

echo "\nall examples finished\n";
?>
