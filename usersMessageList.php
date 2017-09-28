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
		<title>您發送的約會邀請</title>
		<link rel="stylesheet" type="text/css" href="../style.css">
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
			<h2 align="center">您發送的約會邀請</h2>
			<br />
			<div class="table-responsive">
	
			
			</div>
				
			
			
		<input type="hidden" name = "ClientID" value="<?php echo $ClientID ?>">
				<table id="user_data" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th width="11%">頭像</th>
							<th width="10%">可約人姓名</th>
							
							<th width="15%">對話</th>
							<th width="20%">刪除</th>
						
						
						</tr>
						<?php 
						include 'Controller/db.php'; 
						
						
						$Username = $_SESSION['Username'];
						
						/*$sql="SELECT
    DatingNotifications.NotificationID, DatingNotifications.ClientName, DatingNotifications.ClientID, DatingNotifications.ClientUsername,
    DatingNotifications.SenderUsername, MAX(DatingMessages.MessagesSentTime)
    FROM
    DatingNotifications
    INNER JOIN
    DatingMessages
    ON
    DatingNotifications.NotificationID=DatingMessages.NotificationID
    WHERE
    DatingNotifications.SenderUsername='$Username' ORDER BY DatingMessages.MessagesSentTime DESC";*/
						
						
						$sql="SELECT * FROM DatingNotifications WHERE SenderUsername='$Username' ORDER BY NotificationID DESC";
						
						
						//$q = mysqli_query($dbc, $sql);
						error_reporting(0);
						$q = mysqli_query($dbc, $sql);
						
						
						while($r = mysqli_fetch_assoc($q)){
						   
					 ?>
					 
					 <tr>
					 <td><img src="Controller/getProfileImage.php?pic_id=<?php echo $r['ClientID']; ?>" width="190px" height="160px" alt=""></td>
					 <td><?php echo $r['ClientName'];?></td>
					<td><a href="messagesFromUsers.php?messagesFromUsers=<?php echo $r['NotificationID']?>">對話</a></td>
					  <td><a href="Controller/deleteInvitation.php?deleteInvitation=<?php echo $r['NotificationID'] ?>">刪除</a></td>
					  
					 </tr>
					 <?php
					 }
					 ?>
						
					</thead>
				</table>
			
				
			</div>
		
		
		
	</body>
</html>



