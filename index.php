<!-- The first if statement checks if the user is already logged in. If they are not logged in, they will be redirected to the login page. Hence this page is accessible to only logged in users. -->

<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
  }
  include('dbConn.php'); 
?>

<!DOCTYPE html>
<html>
<head>
	<title>WEDE TASK 1</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Home</h2>
		<p> <a href="index.php?logout='1'" style="color: red;">
	</div>

	<div class="content">
		<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
      <?php endif ?>
    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
    	<h1 class="header">Welcome <strong><?php echo $_SESSION['username']; ?></strong></h1>
    	<p> <a href="index.php?logout='1'">logout</a> </p>
      <button class="button-toggle" onclick="toggle('items');">Show Items</button>
    <?php endif ?>

</div>

<div id="items" class="content">
    <!-- Table creation for items -->
    <table >
      <tr>
        <th>Item Sku</th>
        <th>Description</th>
        <th>Price</th> 
        <th>Show Image</th>   
      </tr>    
<?php 
     $files = glob("images/*.*");
    foreach ($files as $image) {
           echo '<img src="'.$image.'" <br>';
         }


    $sql = "SELECT itemID as SKU, description as DESCRIPTION, sellPrice as PRICE from items"; 
    $results = mysqli_query($db, $sql);
     
    if ($results->num_rows > 0) {
        //output of each row
      while ($user=mysqli_fetch_assoc($results)) {
        $temp = "<tr><td>".$user['SKU']."</td><td>".$user['DESCRIPTION']."</td><td>".$user['PRICE']."</td><td><button>Add To Cart</button></td></tr>";
        echo $temp;
        $arrLength++;
      }
       echo "</table>";
     }else {
       echo "0 results";
     }
   
?>
</div>
  <script type="text/javascript">
  function toggle(id){
    var div = document.getElementById(id);
      if (div.style.display =='none') {
        div.style.display = 'block';
      }else {
        div.style.display = 'none';
      }
  }

</script>
</body>
</html>