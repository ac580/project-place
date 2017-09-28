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


include 'Controller/db.php';
include 'Controller/server.php';

if(isset($_GET['viewFullClient'])){
    
    $ClientID = $_GET['viewFullClient'];
    
    $res = mysqli_query($dbc,"SELECT * FROM DatingClients WHERE ClientID='$ClientID'");
    $row = mysqli_fetch_array($res);
    
}

include 'menu.php';


?>

<!DOCTYPE html>
<html>
	<head>
	<link rel="shortcut icon" href="logo/favicon.ico">
		<title>查看可約人資料</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>		
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
		<style>
			body
			{
				margin:0;
				padding:0;
				background-color:#f1f1f1;
			}
			.box
			{
				width:1270px;
				padding:20px;
				background-color:#fff;
				border:1px solid #ccc;
				border-radius:5px;
				margin-top:25px;
			}
		</style>
	</head>
	<body>
	
	<div class="header">
		<h1>查看可約人資料</h1>
	</div>
	

		<form method="POST" enctype="multipart/form-data">
		<input type="hidden" name = "ClientID" value="<?php echo $ClientID ?>">
		
		
<div class="input-group">
<label>頭像</label>
<br/>
<img src="Controller/getProfileImage.php?pic_id=<?php echo $ClientID; ?>" width="200px" height="200px" alt="">
</div>
		

	
		<div class="input-group">
		<br/>
			<label>姓名</label>
			<input type="text" name="ClientName" readonly value="<?php echo $row['ClientName']; ?>"/>
		</div>
		<div class="input-group">
			<label>姓別</label>
			
			<input type="text" name="Sex" readonly value="<?php echo $row['Sex']; ?>"/>
			

		</div>
		<div class="input-group">
			<label>年齡</label>
			<input type="number" name="Age" readonly value="<?php echo $row['Age']; ?>">
		</div>
		<div class="input-group">
			<label>身高 (厘米)</label>
			<input type="number" name="Height" readonly value="<?php echo $row['Height']; ?>">
		</div>
		<div class="input-group">
			<label>上圍 (尺寸)</label>
			<input type="number" name="Chest" readonly value="<?php echo $row['Chest']; ?>">
		</div>
		<div class="input-group">
			<label>腰圍 (尺寸)</label>
			<input type="number" name="Wrist" readonly value="<?php echo $row['Wrist']; ?>">
		</div>
		<div class="input-group">
			<label>臀圍 (尺寸)</label>
			<input type="number" name="Hips" readonly value="<?php echo $row['Hips']; ?>">
		</div>
		<div class="input-group">
			<label>國藉</label>
			
			<input type="text" readonly name="Nationality" value="<?php echo $row['Nationality']; ?>"/>
		</div>
		<div class="input-group">
			<label>教育程度</label>
			<input type="text" readonly name="Education" value="<?php echo $row['Education']; ?>"/>
		</div>
		
		<div class="input-group">
			<label>職業</label>
			<input type="text" readonly name="Occupation" value="<?php echo $row['Occupation']; ?>">
		</div>
		<div class="input-group">
			<label>興趣</label>
			<textarea name = "Hobbies" readonly cols=30  rows=3><?php echo $row['Hobbies'] ?></textarea>
		</div>
		<div class="input-group">
			<label>理想約會地點</label>
			<input type="text" readonly name="Location" value="<?php echo $row['Location']; ?>"/>
			
		</div>
		<div class="input-group">
			<label>性取向</label>
			<input type="text" readonly name="SexualOrientation" value="<?php echo $row['SexualOrientation']; ?>"/>
		</div>
		<div class="input-group">
			<label>更多資料</label>
			<textarea name = "OtherInfo" readonly cols=30  rows=3><?php echo $row['OtherInfo'] ?></textarea>
		</div>
		<div class="input-group">
			<label>所屬會員</label>
			<input type="text" readonly name="Username" value="<?php echo $row['Username']; ?>"/>
		</div>
		
		
		
		<div class="input-group">
			<button type="button" class="btn" id="add_button" data-toggle="modal" data-target="#userModal">發送約會邀請</button>
			
		
		</div>
		<br/>
		<div class="input-group">
			<a href="searchClient.php">返回上一頁</a>
		</div>
		</form>
		
		
	<div id="userModal" class="modal fade">
	<div class="modal-dialog">
		<form action="viewFullClient.php" method="post" id="user_form" enctype="multipart/form-data" style="width: 650px" >
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">向<?php echo $row['ClientName']; ?>發送邀請</h4>
					
				</div>
				<div class="modal-body">
					<label>留段小留言 (可填)</label>
					<br />
					<textarea name = "Comments" id="Comments" cols=50  rows=4></textarea>
					<br />
				</div>
				<div class="modal-footer">
					<input type='hidden' name='ClientID' value='<?php echo $row['ClientID'];?>' />
					<input type='hidden' name='ClientName' value='<?php echo $row['ClientName'];?>' />
					<input type='hidden' name='Username' value='<?php echo $row['Username'];?>' />
					<input type="submit" name="sendNotification" id="sendNotification" class="btn btn-success" value="確認" />
					<button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
				</div>
			</div>
		</form>
	</div>
</div>
		
		
<script type="text/javascript" language="javascript" >
$(document).ready(function(){
	$('#add_button').click(function(){
		//$('#user_form')[0].reset();
	
		
	});		

	
</script>
	
		

		
		
		
		
		
	
	</body>
	
	</html>
	




