
<?php
	// Include the Twilio PHP library
	require '../Services/Twilio.php';

	// Set account sid and auth token
	$sid = 'AC609c3f7d32dfb4dddf8d3b79eac93f41';
	$token = 'f5fe765f35130f11b365a26059a9eed3';

	// my twilio phone number
	$phoneNumber = '832-460-0899';

	// Instantiate a new Twilio Rest Client
	$client = new Services_Twilio($sid, $token);
echo "we are in functions\n";
	function text($number, $message) {
		echo "we are in text\n";
		$sms = $client->account->messages->sendMessage(
			$phoneNumber,
			// the number we are sending to
			$number,
			// the sms body
			$message
		);
		// Display a confirmation message on the screen
		echo "Sent message to $number\n";
	}
	text('+17133677805', 'Hello!');
?>