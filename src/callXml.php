<?php
	header("content-type: text/xml");
	echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
	if (isset($_GET['message']))
		$message = $_GET['message'];
?>
<Response>
	<Say><?php echo $message ?></Say>
</Response>