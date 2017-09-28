<?php
include('db.php');
if( isset($_GET['deleteClient']) )
{
    $ClientID = $_GET['deleteClient'];
    $sql= "DELETE FROM DatingClients WHERE ClientID='$ClientID'";
    $res= mysqli_query($dbc,$sql) or die("Failed".mysql_error());
    echo "<meta http-equiv='refresh' content='0;url=../clientList.php'>";
}