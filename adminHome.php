<?php
session_start();

if (!isset($_SESSION['Username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['Username']);
    header("location: login.php");
}

include('menu.php');

?>


<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" href="logo/favicon.ico">
	<title>主頁</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
	<div class="header">
		<h2>管理員主頁</h2>
	</div>
	<div class="content">

		<!-- notification message -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h3>
					<?php 
						echo $_SESSION['success']; 
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>

		<!-- logged in user information -->
		<?php  if (isset($_SESSION['Username'])) : ?>
			<p><strong><?php echo $_SESSION['Username']; ?> (管理員)</strong></p>
			<br/>
			<p> <a href="adminHome.php?logout='1'" style="color: red;">登出</a> </p>
		<?php endif ?>
	</div>
		
</body>
</html>