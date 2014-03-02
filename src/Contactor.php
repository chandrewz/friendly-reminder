<?php
	// Include the Twilio PHP library
	require '../Services/Twilio.php';
	// Set account sid and auth token
	private $sid = 'AC609c3f7d32dfb4dddf8d3b79eac93f41';
	private $token = 'f5fe765f35130f11b365a26059a9eed3';
	// my twilio phone number
	private $phoneNumber = '832-460-0899';
	private $client;

	function Contactor() {
		$this->client = new Services_Twilio($this->sid, $this->token);
	}

	/**
	 * Sends a text message to a specified number
	 */
	function text($number, $message) {
		$this->client->account->messages->sendMessage(
			$this->phoneNumber,
			// the number we are sending to
			$number,
			// the sms body
			$message
		);
	}