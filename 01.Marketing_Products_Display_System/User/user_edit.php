<?php

session_start();
    if(!$_SESSION['active'])     
    {
        header('Location: ../login.php');       
    }
    

require_once '../Models/user_model.php';
require_once '../database.php';

if(!isset($_REQUEST['submit']))
  {
    
    $model= new Model();
    
    $id = $_GET['id'];

    if(!isset($id)) //user can't hit directly to the url as edit.php. i.e edit button press garera matra edit.php ma jana pauncha.
    {
      header('location:users.php');
    }
    $row = $model->get_by_id($id);

    $username = $row['username'];
    $password = $row['password'];
    $address = $row['address'];
    $contact = $row['contact'];
    $image = $row['image'];

  }
    

else{

    $id = $_POST['id'];

    $username = $_POST['username'];
    $password = $_POST['password'];
    $address= $_POST['address'];
    $contact= $_POST['contact'];
    $image = $_POST['image'];
    

    $image = $_FILES['image']['name'];
    $tempname = $_FILES['image']['tmp_name'];
    move_uploaded_file($tempname, "images/$image");


    $model = new Model();

    
	$rows_affected= $model->user_update($id, $username, $password, $address, $contact, $image);

	if($rows_affected>0)
        {
          header('location:users.php');

    	} //else vitra ko if closing.

	} //else closing

    ?>


<!DOCTYPE html>
<html>

<head>
	<title>User Edit page</title>

	<link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>

<div>
	
<div class="left">
		<a href="../admin.php">

			<img src="../logo.jpg" style="width:185px; height:100px;">	
		</a>	
	</div>
	<div class="right">
  <a href="../logout.php" style="float: right;  padding: 2px;"><img src="../logout_logo.png" style="width:75px; height:100px;"></a>
    <h4>User Edit Form</h4>
  </div>


</div>

<section id="sidebar">
	<nav class="menu">
		<a href="../Category/category.php">Categories</a>
		<a  href="../Product/products.php">Products</a>
		<a  href="users.php">Users</a>
		
	</nav>
</section>


<br>
    

<div style="margin-left:580px; margin-top:150px;" id="formContent"> 


  <form action="user_edit.php" method="POST" enctype="multipart/form-data">
        Username:<br>
        <input type="text" id="username" name="username" placeholder="username.." value="<?php if(isset($username)) echo $username;?>" required><br><br>

        Password:<br>
        <input type="password" id="password" name="password" placeholder="password"  required><br><br>

        Address:<br>
        <input type="text" id="address" name="address" placeholder="address" value="<?php if(isset($address)) echo $address;?>" required><br><br>

        Contact:<br>
        <input type="text" id="contact" name="contact" placeholder="contact" value="<?php if(isset($contact)) echo $contact;?>" required><br><br>
       
        

        User Image:<br>
        <input type="file" id="image" name="image"><br><br>

        <td colspan="2" align="center"><input type="hidden" name="id" value="<?php if(isset($id)) echo $id;?>" >
      <input type="submit" name= "submit" value="Submit">
  </form>


</div>
</body>
</html>

