<?php include('Controller/server.php');
include 'headerBeforeLogin.php';

?>
<!DOCTYPE html>
<html>
<head>
	<title>加入我們</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
	<div class="header">
		<h2>註冊</h2>
	</div>
	
	<form method="post" action="register.php">

		<?php include('Controller/errors.php'); ?>

		<div class="input-group">
			<label>帳戶名稱</label>
			<input type="text" name="Username" value="<?php echo $Username; ?>">
		</div>
		<div class="input-group">
			<label>電郵</label>
			<input type="email" name="UserEmail" value="<?php echo $UserEmail; ?>">
		</div>
		<div class="input-group">
			<label>聯絡號碼</label>
			<input type="number" name="UserContactNumber" value="<?php echo $UserContactNumber; ?>">
		</div>
		<div class="input-group">
			<label>密碼</label>
			<input type="password" name="SetPassword">
		</div>
		<div class="input-group">
			<label>確認密碼</label>
			<input type="password" name="ConfirmPassword">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="createNewUser">確定</button>
		</div>
		<p>
			已經註冊? <a href="login.php">登入</a>
		</p>
	</form>
</body>
</html>