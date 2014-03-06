<?php
	if (isset($_POST['username'])) {
		require_once('src/Database.php');
		$db = new Database();
		$db->connect();
		$user = $db->getUser($_POST['username']);
		$rows = pg_num_rows($user);
		if ($user && $rows > 0) {
			$db->login($_POST['username'], 'password');
			header('Location: welcome.php');
		}
		else exit("Bye.");
	}
?>

<html>

	<head>
		<title>Friendly Reminder Login</title>

		<!-- jQuery -->
		<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>

		<!-- Bootstrap -->
		<script src="assets/js/bootstrap.min.js"></script>
		<link href="assets/css/bootstrap.min.css" rel="stylesheet">

		<style>
		#login-container {
			width: 340px;
			margin: 160px auto;
		}
		body {
			font-size: 2em;
			background-color: rgb(229, 122, 141);
			font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
		}
		</style>

	</head>

	<body>
		<div id="login-container">
			<form class="form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<fieldset>

			<h1><b>Login</b></h1>

			<!-- Text input-->
			<div class="control-group">
			  <label class="control-label" for="username">Username</label>
			  <div class="controls">
			    <input id="username" name="username" type="text" placeholder="" class="input-xlarge" required="">
			    
			  </div>
			</div>

			<!-- Password input-->
			<div class="control-group">
			  <label class="control-label" for="password">Password</label>
			  <div class="controls">
			    <input id="password" name="password" type="password" placeholder="" class="input-xlarge" required="">
			    
			  </div>
			</div>

			<!-- Button -->
			<div class="control-group">
			  <label class="control-label" for=""></label>
			  <div class="controls">
			    <button id="" name="" class="btn btn-info">Login</button>
			  </div>
			</div>

			</fieldset>
			</form>

		</div>
	</body>

</html>