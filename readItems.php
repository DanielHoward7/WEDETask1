<?php

$items = file ("items.txt");
include("dbConn.php");
// echo "<pre>";
// print_r($Proverbs);
// echo "</pre>";
// foreach ($users as $ind=> $user)
  // echo "<p>$user</p>";
    //Create Table users
 	$sql = "drop table items";
 	$result = $db->query($sql);
 if ($result === FALSE){
		echo "<p> Unable to perform SQL Drop Table </p>";
 }
	else{
		echo "<p>  ".$sql. " done ".mysqli_info($db)."</p>";
	}
	
  	$sqlCreate = "CREATE TABLE items (itemID varchar (40), description varchar (255), costPrice int (255), quantity int(255), sellPrice int(255))";
  	$resultCT = $db->query($sqlCreate);
  if ($resultCT === FALSE){
		echo "<p> Unable to perform SQL Create Table </p>";
  }
	else{
		 echo "<p>".$sqlCreate. " done " .mysqli_info($db)."</p>";
	}
	
  $sqlIns = "INSERT INTO items VALUES ";

  // Insert items into items table
  foreach ($items as $ind=> $row)
  {
  	$rowData = explode(',', $row);
	$sqlIns .= "('{$rowData[0]}','{$rowData[1]}','{$rowData[2]}','{$rowData[3]}','{$rowData[4]}'),";
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