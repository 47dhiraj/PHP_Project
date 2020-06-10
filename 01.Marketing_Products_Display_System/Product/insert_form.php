<?php

session_start();
if(!$_SESSION['active'])     
{
    header('Location: ../login.php');       
}


if(isset($_REQUEST['submit']))
  {
       
      require_once '../Models/product_model.php';

      
      
      
      $pname = $_POST['pname'];
    	$pprice = $_POST['pprice'];
      $psize = $_POST['psize'];

      $pimage = $_FILES['pimage']['name'];
    	$tempname = $_FILES['pimage']['tmp_name'];

      move_uploaded_file($tempname, "../images/$pimage");
      
      $category = $_POST['category'];
      
      $model = new Model();
    	
      $rows= $model->get_cid_by_category($category);

      if($rows==NULL)
      {
    ?>

        <script>
            alert("Please ! First Add Category for this Product.");
            window.location.assign("../Category/category.php");
        </script>


    <?php    
      }
           
  
      $cid = $rows['cid'];


      
      $username = $_SESSION['username'];
      
      $rows_affected= $model->insert($pname, $pprice, $psize, $pimage, $username, $cid);
  

      if($rows_affected>0)
        {
           
              header('location: products.php');  
        }

    }
?>

<!DOCTYPE html>
<html>

<head>
	<title>Insert page</title>

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
    <h4>Add New Product</h4>
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
    

<div style="margin-left:620px; margin-top:150px;" id="formContent"> 


  <form action="" method="POST" enctype="multipart/form-data">
        <br>Product Name:<br>
        <input type="text" id="pname" name="pname" placeholder="Product name.." required><br><br>

        Product Price:<br>
        <input type="text" id="pprice" name="pprice" placeholder="Product Price.." required><br><br>

        Product Size:<br>
        <input type="text" id="psize" name="psize" placeholder="Product Size.." required><br><br>

        <tr>
       
				<td align="left"> Choose category </td>

				<td>
        <select name="category" required>

          <option value="Topwear"> Top wear </option>
          <option value="Bottomwear"> Bottom wear </option>
          <option value="Footwear"> Foot wear </option>			
          <option value="Innerwear"> Inner Wear </option>						

        </select>
				</td>
      </tr>
      <br><br>


        Product Image:<br>
        <input type="file" id="product_image" name="pimage"><br><br>

         <input type="submit" name= "submit" value="Submit">
  </form>


</div>
</body>
</html>

