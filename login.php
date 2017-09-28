<?php include('Controller/server.php');
include 'headerBeforeLogin.php';
?>
<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" href="logo/favicon.ico">
	<title>歡迎來到 Simple Date!</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>

	<div class="header">
		<h2>登入</h2>
	</div>
	
	<form method="post" action="login.php">

		<?php include('Controller/errors.php'); ?>

		<div class="input-group">
			<label>帳戶名稱</label>
			<input type="text" name="Username" >
		</div>
		<div class="input-group">
			<label>密碼</label>
			<input type="password" name="UserPassword">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="loginUser">確定</button>
		</div>
		<p>
			還未註冊? <a href="register.php">快加入我們！</a>
		</p>
	</form>

</body>
</html>