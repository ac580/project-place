<?
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

?>
<?php

// Connexion à la base de données
require('bdd.php');
//echo $_POST['title'];
if (isset($_POST['title']) && isset($_POST['start']) && isset($_POST['end']) && isset($_POST['color'])){
	
    $Username = $_SESSION['Username'];
	$title = $_POST['title'];
	$start = $_POST['start'];
	$end = $_POST['end'];
	$color = $_POST['color'];

	$sql = "INSERT INTO events(title, start, end, color,Username) values ('$title', '$start', '$end', '$color','$Username')";
	
	$query = $bdd->prepare( $sql );

	$sth = $query->execute();
	
}
header('Location: ../calendar.php');

	
?>
