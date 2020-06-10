<?php
session_start();
    if(!$_SESSION['active'])     
    {
        header('Location: ../login.php');       
    }


    
    

require_once '../Models/product_model.php';
require_once '../database.php';

if(!isset($_REQUEST['submit']))
  {
    
    $model= new Model();
    
    $pid = $_GET['pid'];

    if(!isset($pid)) //user can't hit directly to the url as edit.php. i.e edit button press garera matra edit.php ma jana pauncha.
    {
      header('location:products.php');
    }
    $row = $model->get_by_pid($pid);

    $pname = $row['pname'];
    $pprice = $row['pprice'];
    $psize = $row['psize'];
    $pimage = $row['pimage'];

  }
    

  else{

    $pid = $_POST['pid'];

    $pname = $_POST['pname'];
    $pprice = $_POST['pprice'];
    $psize = $_POST['psize'];
    

    $pimage = $_FILES['pimage']['name'];
    $tempname = $_FILES['pimage']['tmp_name'];
    move_uploaded_file($tempname, "images/$pimage");

    $category= $_POST['category'];

    $model = new Model();

    $rows= $model->get_cid_by_category($category);

    $cid = $rows['cid'];

    $username = $_SESSION['username'];
   
	$rows_affected= $model->product_update($pid, $pname, $pprice, $psize, $pimage, $username, $cid);

	if($rows_affected>0)
        {
          header('location:products.php');

    	} //else vitra ko if closing.

	} //else closing

    ?>


<!DOCTYPE html>
<html>

<head>
	<title>Edit page</title>

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
    <h4>Edit Form</h4>
  </div>


</div>

<section id="sidebar">
	<nav class="menu">
		<a href="../Category/category.php">Categories</a>
		<a  href="products.php">Products</a>
		<a  href="../User/users.php">Users</a>
		
	</nav>
</section>


<br>
    

<div style="margin-left:600px; margin-top:150px;" id="formContent"> 


  <form action="edit.php" method="POST" enctype="multipart/form-data">
        Product Name:<br>
        <input type="text" id="pname" name="pname" placeholder="Product name.." value="<?php if(isset($pname)) echo $pname;?>" required><br><br>

        Product Price:<br>
        <input type="text" id="pprice" name="pprice" placeholder="Product Price.." value="<?php if(isset($pprice)) echo $pprice;?>" required><br><br>

        Product Size:<br>
        <input type="text" id="psize" name="psize" placeholder="Product Size.." value="<?php if(isset($psize)) echo $psize;?>" required><br><br>

       
			  Choose category:
        <select name="category" required>
          <option value="Topwear"> Top wear </option>
						<option value="Bottomwear"> Bottom wear </option>
						<option value="Footwear"> Foot wear </option>			
            <option value="Innerwear"> Inner Wear </option>										
					</select>
      <br><br>
        

        Product Image:<br>
        <input type="file" id="product_image" name="pimage"><br><br>

        <td colspan="2" align="center"><input type="hidden" name="pid" value="<?php if(isset($pid)) echo $pid;?>" >
      <input type="submit" name= "submit" value="Submit">
  </form>


</div>
</body>
</html>

