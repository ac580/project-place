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
		<title>您收到的約會邀請</title>
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
				background-color:#FFF933;
				color:#2F85A5;
				border:1px solid #ccc;
				border-radius:5px;
				margin-top:25px;
			}
		</style>
	</head>
	<body>
		<div class="container box">
			<h2 align="center">您收到的約會邀請</h2>
			<br />
			<div class="table-responsive">
	
			
			</div>
				
			
			
		<input type="hidden" name = "ClientID" value="<?php echo $ClientID ?>">
				<table id="user_data" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th width="11%">頭像</th>
							<th width="10%">可約人姓名</th>
							<th width="10%">邀請人姓名</th>
							<th width="17%">邀請人資料</th>
							<th width="10%">查看留言</th>
							<th width="15%">對話</th>
							<th width="20%">拒絕</th>
						
						
						</tr>
						<?php 
						include 'Controller/db.php'; 
						
						
						$Username = $_SESSION['Username'];
						
						
						$q = mysqli_query($dbc, "SELECT * FROM DatingNotifications WHERE ClientUsername='$Username' ORDER BY NotificationID DESC");
						error_reporting(0);
						$r = mysqli_query($dbc, $q);
						
						
						while($r = mysqli_fetch_assoc($q)){
						   
					 ?>
					 
					 <tr>
					 <td><img src="Controller/getProfileImage.php?pic_id=<?php echo $r['ClientID']; ?>" width="190px" height="160px" alt=""></td>
					 <td><?php echo $r['ClientName'];?></td>
					 <td><?php echo $r['SenderUsername'];?></td>
					 <td> <button type="button" class="btn" id="view_button" data-toggle="modal" data-target="#userModalView">查看</button></td>
					 <td> <button type="button" class="btn" id="add_button" data-toggle="modal" data-target="#userModal">查看</button></td>
					<td><a href="messagesFromClients.php?messagesFromClients=<?php echo $r['NotificationID']?>">對話</a></td>
					  <td><a href="Controller/rejectInvitation.php?rejectInvitation=<?php echo $r['NotificationID'] ?>">拒絕</a></td>
					 </tr>
					 <?php
					 }
					 ?>
						
					</thead>
				</table>
			
				
			</div>

		
			<div id="userModal" class="modal fade">
	<div class="modal-dialog">
		<form method="post" id="user_form" enctype="multipart/form-data" style="width: 650px" >
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					
					<?php 
						include 'Controller/db.php'; 
						
						
						$Username = $_SESSION['Username'];
						
						
						$q = mysqli_query($dbc, "SELECT * FROM DatingNotifications WHERE ClientUsername='$Username'");
						error_reporting(0);
						$r = mysqli_query($dbc, $q);
						
						
						while($r = mysqli_fetch_assoc($q)){
						   
					 ?>
					<h4 class="modal-title"><?php echo $r['SenderUsername']; ?>給你的留言</h4>
					
				</div>
				<div class="modal-body">
					<label>留言</label>
					<br />
					<textarea name = "Comments" readonly cols=50  rows=5><?php echo $r['Comments'] ?></textarea>
					<br />
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
				</div>
			</div>
			<?php }?>
		</form>
	</div>
</div>


<div id="userModalView" class="modal fade">
	<div class="modal-dialog">
		<form method="post" id="user_form2" enctype="multipart/form-data" style="width: 650px" >
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					
					<?php 
						include 'Controller/db.php'; 
						
						
						$Username = $_SESSION['Username'];
						
						
						$q = mysqli_query($dbc, "SELECT * FROM DatingNotifications WHERE ClientUsername='$Username'");
						error_reporting(0);
						$r = mysqli_query($dbc, $q);
						
						
						while($r = mysqli_fetch_assoc($q)){
						   
					 ?>
					<h4 class="modal-title">邀請人<?php echo $r['SenderUsername']; ?>的資料</h4>
					
				</div>
				<div class="modal-body">
					<label>電郵</label>
					<br />
					<input type="text" name="SenderEmail" value="<?php echo $r['SenderEmail']; ?>"/>
					<br />
					<label>聯絡號碼</label>
					<br />
					<input type="text" name="SenderContactNumber" value="<?php echo $r['SenderContactNumber']; ?>"/>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
				</div>
			</div>
			<?php }?>
		</form>
	</div>
</div>
		
		
		
	</body>
</html>



