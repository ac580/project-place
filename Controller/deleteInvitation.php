<?php

include('db.php');
if(isset($_GET['deleteInvitation']) )
{
    $NotificationID = $_GET['deleteInvitation'];
    $sql= "DELETE FROM DatingNotifications WHERE NotificationID=$NotificationID";
    $res= mysqli_query($dbc,$sql) or die("Failed".mysql_error());
    
   
    echo "<meta http-equiv='refresh' content='0;url=../usersMessageList.php'>";
}
?>