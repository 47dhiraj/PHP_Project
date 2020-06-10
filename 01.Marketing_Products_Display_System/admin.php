<?php

	session_start();
    if(!$_SESSION['active'])     
    {
        header('Location: login.php');       
    }
 
	$username = $_SESSION['username'];

?>

<!DOCTYPE html>
<html>

<head>
	<title>Admin page</title>

	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div>
	
	<div class="left">
		<a href="admin.php">

			<img src="logo.jpg" style="width:185px; height:100px;">	
		</a>	
	</div>

	<div class="right">

	<a href="logout.php" style="float: right;  padding: 2px;"><img src="logout_logo.png" style="width:75px; height:100px;"></a>
	<h4 >Admin Board</h4>

	</div>


</div>

<section id="sidebar">
	<nav class="menu">
		<a href="Category/category.php">Categories</a>
		<a  href="Product/products.php">Products</a>
		<a  href="User/users.php">Users</a>
		
	</nav>
</section>

<h1 style="margin-left: 710px; color:orangered;" ><?php echo "Hello " . "  ". $username . " ! "; ?></h1>

 <img src="admin.jpg" style="margin-top:10px; margin-left:290px; border: solid black 5px;">
</body>
</html>

