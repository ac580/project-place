<?php
session_start();

if (!isset($_SESSION['Username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../login.php');
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['Username']);
    header("location: ../login.php");
}

include 'db.php';



$msg = $_REQUEST['msg'];
$NotificationID = $_REQUEST['id'];
$ClientName = $_REQUEST['cn'];


mysqli_query($dbc,"INSERT INTO DatingMessages (Messages,MessagesSenderName,NotificationID) VALUES ('$msg','$ClientName',$NotificationID)");



?>