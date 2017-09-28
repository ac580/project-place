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
include('Controller/server.php');
include 'menu.php';


?>
<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" href="logo/favicon.ico">
	<title>新增可約的人</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
	<div class="header">
		<h1>新增可約的人</h1>
		<p>*必填</p>
	</div>
	
	<form method="post" action="addClient.php" enctype="multipart/form-data">

		<?php include('Controller/errors.php'); ?>	
		<input type="hidden" name = "Username" value="<?php echo $_SESSION['Username'] ?>">
		
		
		<div class="input-group">
		<label>上載頭像 *</label>
		<br/>
		<input type="file" name="image" class="btn">                     
        </div>  
	
		<div class="input-group">
			<label>姓名 *</label>
			<input type="text" name="ClientName" value="<?php echo $ClientName; ?>">
		</div>
		<div class="input-group">
			<label>姓別 *</label>
			<select name="Sex">
			<option value="" selected disabled hidden>請選擇</option>
			<option value="男">男</option>
			<option value="女">女</option>
			</select>
		</div>
		<div class="input-group">
			<label>年齡 *</label>
			<input type="number" name="Age" value="<?php echo $Age; ?>">
		</div>
		<div class="input-group">
			<label>身高 (厘米)</label>
			<input type="number" name="Height" value="<?php echo $Height; ?>">
		</div>
		<div class="input-group">
			<label>上圍 (尺寸)</label>
			<input type="number" name="Chest" value="<?php echo $Chest; ?>">
		</div>
		<div class="input-group">
			<label>腰圍 (尺寸)</label>
			<input type="number" name="Wrist" value="<?php echo $Wrist; ?>">
		</div>
		<div class="input-group">
			<label>臀圍 (尺寸)</label>
			<input type="number" name="Hips" value="<?php echo $Hips; ?>">
		</div>
		<div class="input-group">
			<label>國藉 *</label>
			<select name="Nationality">
			<option value="" selected disabled hidden>請選擇</option>
			<option value="香港">香港</option>
			<option value="澳門">澳門</option>
			<option value="台灣">台灣</option>
			<option value="中國大陸">中國大陸</option>
			<option value="英國">英國</option>
			<option value="美國">美國</option>
			<option value="加拿大">加拿大</option>
			<option value="澳洲">澳洲</option>
			<option value="紐西蘭">紐西蘭</option>
			<option value="其他">其他</option>
			<option value="不便透露">不便透露</option>
			</select>
		</div>
		<div class="input-group">
			<label>教育程度 *</label>
			<select name="Education">
			<option value="" selected disabled hidden>請選擇</option>
			<option value="小學或以下">小學或以下</option>
			<option value="中學">中學</option>
			<option value="文憑或證書">文憑／證書</option>
			<option value="副學士">副學士</option>
			<option value="學士">學士</option>
			<option value="碩士">碩士</option>
			<option value="博士或以上">博士或以上</option>
			<option value="不便透露">不便透露</option>
			</select>
		</div>
		
		<div class="input-group">
			<label>職業</label>
			<input type="text" name="Occupation" value="<?php echo $Occupation; ?>">
		</div>
		<div class="input-group">
			<label>興趣</label>
			<textarea rows="6" cols="60" name="Hobbies"></textarea>
		</div>
		<div class="input-group">
			<label>理想約會地點 *</label>
			<select name="Location">
			<option value="" selected disabled hidden>請選擇</option>
			<option value="港島">港島</option>
			<option value="九龍">九龍</option>
			<option value="新界">新界</option>
			<option value="離島">離島</option>
			<option value="其他">其他</option>
			</select>
		
		</div>
		<div class="input-group">
			<label>性取向</label>
			<select name="SexualOrientation">
			<option value="異性">異性</option>
			<option value="同性">同性</option>
			<option value="雙性">雙性</option>
			</select>
		</div>
		<div class="input-group">
			<label>更多資料</label>
			<textarea rows="6" cols="60" name="OtherInfo"></textarea>
		</div>
		
		
		<div class="input-group">
			<button type="submit" class="btn" name="createNewClient">確定</button>
		</div>
		<p>
			<a href="home.php">返回主頁</a>
		</p>
	</form>
</body>
</html>