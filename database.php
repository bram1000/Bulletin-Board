<?php
	$GLOBALS["servername"] = "localhost";
	$GLOBALS["username"] = "username";
	$GLOBALS["password"] = "password";
	$GLOBALS["database"] = "forum_test";
	$GLOBALS["table"] = "posts";

	function GetPosts()
	{
		$servername = $GLOBALS["servername"];
		$username   = $GLOBALS["username"];
		$password   = $GLOBALS["password"];
		$database   = $GLOBALS["database"];
		$table      = $GLOBALS["table"];
		
		$con = new mysqli($servername, $username, $password);
		if(mysqli_connect_errno())
		{
			die("MySQL connection failed!");
		}
		
		$res = $con->query("CREATE DATABASE IF NOT EXISTS $database");
		$con->select_db($database);
		
		$con->query("
	    	CREATE TABLE IF NOT EXISTS $table (
	        	id INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
   	     	msg VARCHAR(2000),
      	  	date TIMESTAMP
    		)
		");
	
		$result = $con->query("SELECT * FROM $table");
		
		$con->close();
		
		return $result;
	}
	
	function WritePost($msg)
	{
		$servername = $GLOBALS["servername"];
		$username   = $GLOBALS["username"];
		$password   = $GLOBALS["password"];
		$database   = $GLOBALS["database"];
		$table      = $GLOBALS["table"];
		
		$con = new mysqli($servername, $username, $password);
		if(mysqli_connect_errno())
		{
			die("MySQL connection failed!");
		}
		
		$res = $con->query("CREATE DATABASE IF NOT EXISTS $database");
		$con->select_db($database);
		
		$cmdo = $con->prepare("INSERT INTO $table (msg) VALUES(?)");
		$cmdo->bind_param('s', $msg);
		$cmdo->execute();
	
		$result = $con->query("SELECT * FROM $table");
		
		$con->close();
	}
?>