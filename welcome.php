<?php
session_start();
if ($_SESSION['user'])
	echo 'Session is: ' . $_SESSION['user'];
else
	echo 'No session found';
?>