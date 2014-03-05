<?php

require '../libs/twilio/Twilio.php'; // include the Twilio PHP library
require '../libs/context-io/class.contextio.php'; // likewise context.io library

class Contactor {

	/**
	 * Twilio vars
	 */
	private $client; // Twilio Object
	private $sid = 'AC609c3f7d32dfb4dddf8d3b79eac93f41'; // account sid
	private $token = 'f5fe765f35130f11b365a26059a9eed3'; // auth token
	private $phoneNumber = '832-460-0899'; // my twilio phone number
	private $version = '2010-04-01';

	/**
	 * context.io vars
	 */
	private $contextIO; // ContextIO Object
	private $key = '8kppd9xb'; // consumerKey
	private $secretKey = 'YEj7wF0pwSF9XeyI'; // consumerSecret

	/**
	 * Constructor
	 */
	public function Contactor() {
		$this->client = new Services_Twilio($this->sid, $this->token, $this->version);
		$this->contextIO = new ContextIO($this->key, $this->secretKey);
	}

	/**
	 * Sends a text message to a specified number
	 */
	public function text($number, $message) {
		$sms = $this->client->account->messages->sendMessage(
			$this->phoneNumber,
			// the number we are sending to
			$number,
			// the sms body
			$message
		);
		return $sms;
	}

	/**
	 * Calls a number with an automated message.
	 */
	public function call($number, $message) {
		//
		// Initiate a new outbound call
		$call = $this->client->account->calls->create(
			$this->phoneNumber, // number of the phone initiating the call
			$number, // number of the phone receiving call
			'http://friendly-reminder.herokuapp.com/src/callXml.php?message=' . $message // The URL Twilio will request when the call is answered
		);
	}
}