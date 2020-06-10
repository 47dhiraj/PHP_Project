<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
    <div class="left">
		<a href="../admin.php">

			<img src="../logo.jpg" style="width:185px; height:100px;">	
		</a>	
	</div>
	<div class="right">
        <a href="../logout.php" style="float: right;  padding: 2px;"><img src="../logout_logo.png" style="width:75px; height:100px;"></a>
        
        <h4>Products</h4>
    </div>
<?php
   
	session_start();
    if(!$_SESSION['active'])     
    {
        header('Location: ../login.php');       
    }

  
    
    include '../Models/product_model.php';

    
    include '../sidebar.php';

    $model= new Model();
    $rows=$model->retrieve_from_store();     


?>

<?php

  if(isset($_REQUEST['search_button']))
        {
                $database = new Database();

                $pname = $_REQUEST['pname'];

                $parameters= ['pname'=>$pname];

                $sql = "SELECT * FROM store WHERE pname= :pname";
                $rows = $database->fetchAll($sql, $parameters);
        

        } // closing of if
  
?>




<div style="margin-top:120px;">
<hr>
<div class="searchbox">
<button style="float:left; margin-left: 15px; margin-top:13px;" type="submit" name="insert_button"><a href="insert_form.php" style="color:white">Add Product</a></button>

<form action="" method="POST">
  <input type="text" placeholder="Search by Name.." name="pname" id="Pname" required>
  <button type="submit" name="search_button" style="float:right; margin-right: 25px; margin-top:13px;">Search</button>
</form>

</div>

<hr>
<table align="center" width="55%"  border="1" style="margin-left: 405px; margin-top: 30px;">
        <tr>
            <th>S.N</th>
            <th>Product Name</th>
            <th>Price(Rs)</th>
            <th>Size</th>
            <th>Image</th>
            <th>Added / Updated By</th>     
            <th>Action</th>     
        </tr>

        <?php

//URL bata value aauna pani sakney ra na aauna pani sakney bela tala ko if else condition use garincha 

if(!isset($_GET['cid'])) //url bata value tanda exact yehi line ko syntax  follow garni 
{
    
    if(count($rows)==0)
    {
       echo "<tr ><td align='center' colspan='12'> Sorry!! Requested Product is not available !!</td></tr>";
    }

else{

       $count=0;
       foreach($rows as $row):
           $count++;
?>
           <tr style="text-align:center;">
               <td> <?php echo $count;?> </td>
               <td> <?php echo $row['pname'];?> </td>           
               <td> <?php echo $row['pprice'];?> </td>           
               <td> <?php echo $row['psize'];?> </td>           
               <td style="width:110px; height: 100px;" align="center"><img src="../images/<?php echo $row['pimage']; ?>" style="width:108px; height: 130px;"></td>
               <td> <?php echo $row['username'];?> </td> 
               <td>
               <a href="edit.php?pid=<?php echo $row['pid'];?>" ><input type="submit" value="  Edit  "></a><br>
               
               <a href="delete.php?pid=<?php echo $row['pid']; ?>"><input type="submit" value="Delete"></a><br>

                
           </td>           
           </tr>
    <?php endforeach;?>
   
<?php  } 

   
}


//Main ELSE
else
{
    
    $cid= $_GET['cid'];

    $rows=$model->retrieve_from_category_by_cid($cid); 

     if(count($rows)==0)
    {
       echo "<tr ><td align='center' colspan='12'>Sorry!! Requested Product is not available !!</td></tr>";
    }

    else{

       $count=0;
       foreach($rows as $row):
           $count++;
?>
           <tr style="text-align:center;">
               <td> <?php echo $count;?> </td>
               <td> <?php echo $row['pname'];?> </td>           
               <td> <?php echo $row['pprice'];?> </td>           
               <td> <?php echo $row['psize'];?> </td>           
               <td align="center"><img src="../images/<?php echo $row['pimage']; ?>" style="max-width: 100px;  max-height: 100px;"></td> 
               <td> <?php echo $row['username'];?> </td> 
               <td>
               <a href="edit.php?pid=<?php echo $row['pid'];?>" ><input type="submit" value="  Edit  "></a><br>
               
               <a href="delete.php?pid=<?php echo $row['pid']; ?>"><input type="submit" value="Delete"></a><br>

                
           </td>           
           </tr>
    <?php endforeach;?>
   
        <?php  
        } 
        ?>

        <script>
        
        document.getElementById("Pname").addEventListener("mouseover", function(e) 
        {
        
            window.location.assign("products.php");
        
        });

        </script>

    <?php
    }
            
    ?>

        
</table>
</body>
</html>