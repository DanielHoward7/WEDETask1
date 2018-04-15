<!-- 
	Name: Daniel
	Surname: Howard
	Student Number: 16000911
	Declaration:
	This is my own code and any code from other sources will be referenced.
-->
<?php

$users = file ("userData.txt");
include("dbConn.php");
// echo "<pre>";
// print_r($Proverbs);
// echo "</pre>";
// foreach ($users as $ind=> $user)
  // echo "<p>$user</p>";
    //Create Table users
 	$sql = "drop table users";
 	$result = $db->query($sql);
 if ($result === FALSE){
		echo "<p> Unable to perform SQL Drop Table </p>";
 }
	else{
		echo "<p>  ".$sql. " done ".mysqli_info($db)."</p>";
	}
	
  	$sqlCreate = "CREATE TABLE users (email varchar (40), username varchar (255), password varchar (40))";
  	$resultCT = $db->query($sqlCreate);
  if ($resultCT === FALSE){
		echo "<p> Unable to perform SQL Create Table </p>";
  }
	else{
		 echo "<p>".$sqlCreate. " done " .mysqli_info($db)."</p>";
	}
	
  $sqlIns = "INSERT INTO users VALUES ";

  // Insert users into users table
  foreach ($users as $ind=> $row)
  {
  	$rowData = explode(',', $row);
	$sqlIns .= "('{$rowData[0]}','{$rowData[1]}','{$rowData[2]}'),";
  }
	$sqlIns = substr($sqlIns,0,strlen($sqlIns)-1);
	echo $sqlIns;
	$resultA = $db->query($sqlIns);
	if ($resultA === FALSE){
		echo "<p> Unable to perform SQL Insert </p>";
	}
	else{
		echo "<p> ".$sqlIns. " done " .mysqli_get_host_info($db)."</p>";
	}
//works but no data in db, ask about importing non hashed passes
?>