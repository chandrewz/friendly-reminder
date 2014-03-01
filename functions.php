<?php
	// Include the Twilio PHP library
	require 'Services/Twilio.php';

	// Set account sid and auth token
	$sid = 'AC609c3f7d32dfb4dddf8d3b79eac93f41';
	$token = 'f5fe765f35130f11b365a26059a9eed3';

	// my twilio phone number
	$phoneNumber = '832-460-0899';

	// Instantiate a new Twilio Rest Client
	$client = new Services_Twilio($sid, $token);

	// sends a text message to a specified number
	function text($number, $message) {
		global $client, $phoneNumber;
		$sms = $client->account->messages->sendMessage(
			$phoneNumber,
			// the number we are sending to
			$number,
			// the sms body
			$message
		);
	}

	function pg_connection_string() {
		return 'dbname=db1rn4rj1g5jdl host=ec2-54-197-241-94.compute-1.amazonaws.com port=5432 user=mbykljryroouwe password=2QKn-hc70AaFuxzAvwj-Mh3f22 sslmode=require';
	}

	function connect() {
		# Establish db connection
		$db = pg_connect(pg_connection_string());
		if (!$db) {
			echo "Database connection error.";
			return null;
		}
		return pg_query($db, "SELECT statement goes here");
	}

	function create() {
		$db = pg_connect(pg_connection_string());
		if (!$db) {
			echo "Database connection error.";
			return null;
		}
		$result = pg_query($db, "CREATE TABLE reminder(reminder_id serial primary key, type text, to text, message text, time timestamp, sent boolean);");
		if (!$result) {
			echo "Query failed.";
			return null;
		}
		echo "Created!";
		return $result;
	}
?> 