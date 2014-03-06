<?php
	if (isset($_POST['username'])) {
		require_once('src/Database.php');
		$db = new Database();
		$db->connect();
		$user = $db->getUser($_POST['username']);
		$rows = pg_num_rows($user);
		if ($user && $rows > 0) header('Location: welcome.php');
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

	</head>

	<body>
<form class="form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<fieldset>

<!-- Form Name -->
<legend>Form Name</legend>

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

	</body>

</html>