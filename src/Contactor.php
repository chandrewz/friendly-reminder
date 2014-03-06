<?php

require_once(realpath(dirname(__FILE__) . '/../libs/twilio/Twilio.php')); // include the Twilio PHP library
require_once(realpath(dirname(__FILE__) . '/../libs/context-io/class.contextio.php')); // likewise context.io library

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
	private $accountId = '53155bc43bcc88cc716a92c5'; // andrewsmail1@gmail.com

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
		// Initiate a new outbound call
		$call = $this->client->account->calls->create(
			$this->phoneNumber, // number of the phone initiating the call
			$number, // number of the phone receiving call
			'http://friendly-reminder.herokuapp.com/src/callXml.php?message=' . $message // The URL Twilio will request when the call is answered
		);
	}

	/**
	 * Based on an email, reuturn the emailId
	 */
	public function getEmailId($email) {
		$args = array('email' => $email);
		$r = $this->$contextIO->listAccounts($args);
		$obj = $r->getRawResponse();
		$json = json_decode($obj);
		return $json[0]->{'id'};
	}

	public function getFriendlyReminderEmails($from, $to) {
		$accountId = $this->getEmailId($from);
		$args = array('to'=>$to, 'subject'=>'/friendly-reminder/', 'limit'=>20);
		$r = $this->$contextIO->listMessages($accountId, $args);
		return $r->getRawResponse();
	}
}