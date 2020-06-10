<?php

session_start();
    if(!$_SESSION['active'])     
    {
        header('Location: ../login.php');       
    }
    

require_once '../Models/category_model.php';


if(!isset($_REQUEST['submit']))
  {
    
    $model= new Model();
    
    $cid = $_GET['cid'];

    if(!isset($cid)) //user can't hit directly to the url as edit.php. i.e edit button press garera matra edit.php ma jana pauncha.
    {
      header('location:category.php');
    }
    $row = $model->get_by_cid($cid);

    $cimage = $row['cimage'];
  }
    

  else{

    $cid = $_POST['cid'];

    $cimage = $_FILES['cimage']['name'];
    $tempname = $_FILES['cimage']['tmp_name'];
    move_uploaded_file($tempname, "../images/$pimage");


    $model = new Model();
   
	$rows_affected= $model->category_update($cid, $cimage);

	if($rows_affected>0)
        {
          header('location:category.php');

    	} //else vitra ko if closing.

	} //else closing

    ?>


<!DOCTYPE html>
<html>

<head>
	<title>User Edit Page</title>

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
    <h4>User Edit </h4>
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


<div style="margin-left:625px; margin-top:150px;" id="formContent"> 




  <form action="category_edit.php" method="POST" enctype="multipart/form-data">
  

  
  <img src="../<?php if(isset($cimage)) echo $cimage; ?>" style="max-height:400px; max-width:350px;" ><br><br>

      Category Image:<br><br>

      <input type="file" id="cimage" name="cimage" ><br><br>

      <td colspan="2" align="center"><input type="hidden" name="cid" value="<?php if(isset($cid)) echo $cid;?>" >
      <input type="submit" name= "submit" value="Submit"> 
  </form>


  </div>
</body>
</html>


