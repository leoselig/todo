<?php

$servername = 'localhost';
$dbuser = "dbotodo";
$usrpass = "kM6U2rAg";
$dbname = "dbtodo";

// connect to mysql
$db_connect_todo = mysqli_connect($servername, $dbuser, $usrpass);

// check connectiopn
if (!$db_connect_todo) {
	die('Connection failed: ' . mysqli_connect_error());
	} else {
		echo 'Connected to ' . '\'' . $servername . '\'' . '<br/><br/>';
	}

// Create database
//		$sql_create_db = 'CREATE DATABASE ' . $dbname;
//		if (mysqli_query($db_connect_todo, $sql_create_db)) {
//			echo 'Database was created successfully.';
//		} else {
//			echo 'Trying to create database<br/>...<br/>Error: ' . mysqli_error($db_connect_todo);
//		}

// Select Database
$db_select = mysqli_select_db( $db_connect_todo, $dbname )
or die ('Database selection failure');


?>