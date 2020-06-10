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
		<h4>Category</h4></div>

		
<?php

session_start();
if(!$_SESSION['active'])     
{
	header('Location: ../login.php');       
}

include '../Models/category_model.php';

include '../sidebar.php';

$model= new Model();
$rows=$model->retrieve_from_category();   

?>



<div class="searchbox">
<button style="float:left; margin-left: 15px; margin-top:13px;" type="submit" name="add_category"><a href="add_category.php" style="color:white">Add Category</a></button>
</div>
<div>

	<table align="center" width="50%"  border="1" style="margin-left:450px; margin-top: 150px; text-align:center;" >

	<tr style="background-color: #000; color: #fff;">
		<th>No.</th>
		<th>Items</th>
		<th>Image</th>
		<th>Action</th>
	
	</tr>
	
	<?php
        
        if(count($rows)==0)
                 {
                    echo "<tr ><td align='center' colspan='12'> Sorry!! No Categories to Display !!</td></tr>";
                 }
        
            else{

                    $count=0;
                    foreach($rows as $row):
                        $count++;
        ?>
                        <tr style="text-align:center;">
                            <td> <?php echo $count;?> </td>
							<td><a href="../Product/products.php?cid=<?php echo $row['cid']; ?>"><?php echo $row['cname'];?></a></td>
							<td style="width:130px; height: 100px;" align="center"><img src="../images/<?php echo $row['cimage']; ?>" style="width:125px; height: 133px;"></td>

							<td>
							 <a href="category_edit.php?cid=<?php echo $row['cid'];?>" ><input type="submit" value="  Edit  "></a><br>

							 <a href="category_delete.php?cid=<?php echo $row['cid']; ?>"><input type="submit" value="Remove"></a><br>
				         	</td>

                        </tr>
                 <?php endforeach;?>
                
        <?php  } ?>



	</table>

</div>

</body>
</html>