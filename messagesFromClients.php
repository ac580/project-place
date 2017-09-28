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


include('Controller/db.php');
if( isset($_GET['messagesFromClients']) )
{
    $NotificationID = $_GET['messagesFromClients'];

    $result = mysqli_query($dbc,"SELECT * FROM DatingNotifications WHERE NotificationID='$NotificationID'");
    $row = mysqli_fetch_array($result);
    
 

    
}
include 'menu.php';


?>

<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" href="logo/favicon.ico">
	<title>跟邀請人對話</title>
	<link rel="stylesheet" type="text/css" href="../style.css">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>		
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script
  src="http://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous"></script>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
	
	<script>

function submitChat() {
	if(form1.msg.value == '') {
		alert("請輸入訊息");
		return;
	}
	var msg = form1.msg.value;
	var id = form1.NotificationID.value;
	var cn = form1.ClientName.value;
	var xmlhttp = new XMLHttpRequest();
	form1.reset();
	
	
	xmlhttp.onreadystatechange = function() {
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById('chatlogs').innerHTML = xmlhttp.responseText;
		}
	}
	
	xmlhttp.open('GET','Controller/sendMessagesFromClients.php?msg='+msg+'&id='+id+'&cn='+cn,true);

	xmlhttp.send();

}
$(document).ready(function(e){

	
	$.ajaxSetup({
		cache: false,
	
		
	});
	setInterval( function(){ $('#chatlogs').load('Controller/receiveMessages.php?id=<?php echo $NotificationID ?>'); }, 500 );
});


</script>
	
</head>
<body>
	<div class="header">
	
	
		<h1>您現在跟<?php echo $row['SenderUsername']; ?>對話</h1>
	</div>
	
	<input type="hidden" name = "NotificationID" value="<?php echo $NotificationID ?>">
	</form>
	<form name="form1" id="form1">
	<input type="hidden" name = "NotificationID" value="<?php echo $NotificationID ?>">
	<input type="hidden" name="ClientName" value="<?php echo $row['ClientName']; ?>"/>
		
			<div class="input-group">
	
<div id="chatlogs">
正在載入對話...
</div>

	</div>

		
		
		<div class="input-group">
	
		<br/>
		<textarea placeholder="輸入訊息" name="msg" cols=30  rows=5></textarea> 
		<br/>
		<a href="#" onclick="submitChat()">發送訊息</a><br /><br />  
		<a href="notificationReceiverList.php">回到邀請頁</a><br /><br />          
        </div>  
        
	</form>
</body>
</html>