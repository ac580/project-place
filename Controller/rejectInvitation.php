<?php

include('db.php');
if( isset($_GET['rejectInvitation']) )
{
    $NotificationID = $_GET['rejectInvitation'];
    $sql= "DELETE FROM DatingNotifications WHERE NotificationID=$NotificationID";
    $res= mysqli_query($dbc,$sql) or die("Failed".mysql_error());
    //echo "<meta http-equiv='refresh' content='0;url=notificationReceiverList.php'>";
   
    $_SESSION['success'] = "你已成功拒絕這個邀請";
    echo "<meta http-equiv='refresh' content='0;url=../notificationReceiverList.php'>";
}

?>