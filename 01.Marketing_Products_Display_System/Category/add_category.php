<?php

session_start();
if(!$_SESSION['active'])     
{
    header('Location: ../login.php');       
}
  

if(isset($_REQUEST['submit']))
{
     
    require_once '../Models/category_model.php';
    require_once '../database.php';
    

    
    $cname = $_POST['cname'];
  
    $cimage = $_FILES['cimage']['name'];
    $tempname = $_FILES['cimage']['tmp_name'];

    move_uploaded_file($tempname, "../images/$cimage");

    $model = new Model();
    
    $rows_affected= $model->add_category($cname, $cimage);


    if($rows_affected>0)
      {
         
            header('location: category.php');  
      }

  }
?>

<!DOCTYPE html>
<html>

<head>
<title>Add category page</title>

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
  <h4>Add New Category</h4>
</div>


</div>

<section id="sidebar">
<nav class="menu">
  <a href="category.php">Categories</a>
  <a  href="../Product/products.php">Products</a>
  <a  href="../User/users.php">Users</a>
  
</nav>
</section>



<br>
  

<div style="margin-left:600px; margin-top:150px;" id="formContent"> 


<form action="" method="POST" enctype="multipart/form-data">
      <br>Category Name:<br>
      <input type="text" id="cname" name="cname" placeholder="Category name.." required><br><br>


      Category Image:<br>
      <input type="file" id="cimage" name="cimage"><br><br>

       <input type="submit" name= "submit" value="Submit">
</form>


</div>
</body>
</html>

