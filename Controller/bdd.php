<?php
try
{
	//$bdd = new PDO('mysql:host=127.0.0.1;dbname=xampp;charset=utf8', 'root', '');
	$bdd = new PDO('mysql:host=sql8.freemysqlhosting.net:3306;dbname=sql8170829;charset=utf8', 'sql8170829', 'SlPlzHaDzE');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
