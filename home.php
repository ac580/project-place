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

include 'menu.php';


?>




<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" href="logo/favicon.ico">
<title>主頁</title>
	
	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>


  
  
</head>

<body>


	<div class="header">
	
		<h2>會員主頁</h2>
	
	
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
		 <p><strong><?php echo $_SESSION['Username']; ?> (會員)</strong></p>
		<br/>
			
		<?php endif ?>
	</div>
	
	
	
	
		
</body>
</html>