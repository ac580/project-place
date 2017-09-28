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
		<title>可約人名單</title>
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
			<h2 align="center">你所屬的可約人一覽</h2>
			<br />
			<div class="table-responsive">
				<br /><br />
				<table id="user_data" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th width="15%">頭像</th>
							<th width="10%">姓名</th>
							<th width="10%">姓別</th>
							<th width="10%">年齡</th>
							<th width="15%">國藉</th>
							<th width="10%">性取向</th>
							<th width="15%">更改資料</th>
							<th width="15%">刪除可約人</th>
						
						
						</tr>
						<?php 
						include 'Controller/db.php'; 
						
						
						$Username = $_SESSION['Username'];
						
						
						$q = mysqli_query($dbc, "SELECT * FROM DatingClients WHERE Username='$Username'");
						error_reporting(0);
						$r = mysqli_query($dbc, $q);
						
						
						while($r = mysqli_fetch_assoc($q)){
						   
					 ?>
					 
					 <tr>
					 <td><img src="Controller/getProfileImage.php?pic_id=<?php echo $r['ClientID']; ?>" width="190px" height="160px" alt=""></td>
					 <td><?php echo $r['ClientName'];?></td>
					 <td><?php echo $r['Sex'];?></td>
					 <td><?php echo $r['Age'];?></td>
					 <td><?php echo $r['Nationality'];?></td>
					 <td><?php echo $r['SexualOrientation'];?></td>
					 <td><a href="editClient.php?editClient=<?php echo $r['ClientID'] ?>">更新</a></td>
					  <td><a href="Controller/deleteClient.php?deleteClient=<?php echo $r['ClientID'] ?>">刪除</a></td>
					 </tr>
					 <?php
					 }
					 ?>
						
					</thead>
				</table>
				
			</div>
		</div>
	</body>
</html>



