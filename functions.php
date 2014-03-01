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

	/**
	 * Sends a text message to a specified number
	 */
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

	/**
	 * postgresql db connection string
	 * init: CREATE TABLE reminder(reminder_id serial, reminder_type text, reminder_to text, reminder_message text, reminder_time timestamp, reminder_sent boolean);
	 */
	function pg_connection_string() {
		return 'dbname=db1rn4rj1g5jdl host=ec2-54-197-241-94.compute-1.amazonaws.com port=5432 user=mbykljryroouwe password=2QKn-hc70AaFuxzAvwj-Mh3f22 sslmode=require';
	}

	/**
	 * Adds a record to the database.
	 */
	function reminder($type, $to, $message, $timestamp) {
		# Establish db connection
		$db = pg_connect(pg_connection_string());
		if (!$db) return null;
		$query = "INSERT INTO reminder(reminder_type, reminder_to, reminder_message, reminder_time) VALUES ('$type', '$to', '$message', '$timestamp');";
		return pg_query($db, $query);
	}

	function select() {
		$db = pg_connect(pg_connection_string());
		if (!$db) return null;
		$query = 'SELECT * FROM reminder;';
		return pg_query($db, $query);
	}
?> 