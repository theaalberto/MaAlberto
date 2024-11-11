<?php
  $dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$db = "social_media";

	$conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);

	if(!$conn)
	{
		die("Connection Failed. ". mysqli_connect_error());
		echo "can't connect to database";
	}

  function executeQuery($query){
    $conn = $GLOBALS['conn'];
	$result = mysqli_query($conn, $query);
    return mysqli_query($conn, $query);
  }
?>
