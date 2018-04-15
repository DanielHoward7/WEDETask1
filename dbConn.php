<!-- THIS ARE MY OWN CODEs -->

<?php

	//Connect to db
	$db = new mysqli("localhost","root","", "test");
	if  (!$db)
		$ErrorMsgs[] = "The database server is not available.";
	else
		//echo "<p>Connection is valid</p>";
?>