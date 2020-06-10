<?php
session_start();
if(!$_SESSION['active'])     
{
    header('Location: ../login.php');       
}
   
require_once '../Models/category_model.php';
require_once '../database.php';

if(!isset($_POST['yes_button'])) 
{
    $cid = $_GET['cid']; // value from url parameter
}
else 
{
    $cid = $_POST['cid']; // value from hidden field
    
    $model = new Model();

    if($model->category_delete($cid)) 
    {

        header('location: category.php');
    }
    else 
    {
        $error = 'User could not be deleted.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Category Delete</title>
    <link rel="stylesheet" href="../style.css">
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
    <h4>Remove Category </h4>
  </div>


</div>

<section id="sidebar">
	<nav class="menu">
		<a href="category.php">Categories</a>
		<a  href="../Product/products.php">Products</a>
		<a  href="../User/users.php">Users</a>
		
	</nav>
</section>



    <?php if(isset($error)): ?>
        <p style="color: red"><?php echo $error; ?></p>
    <?php endif; ?>

<br>
    <table align="center" width="50%"  border="1" style="margin-left:440px; margin-top: 170px;">
        <tr >
            <th>S.N</th>
            <th>Item</th>
            <th>Image</th>     
            <th>Remove Sure?</th>     
        </tr>

        <?php
            if(isset($_REQUEST['cid'])){

                $database = new Database();

                $cid = $_REQUEST['cid'];

                $parameters= ['cid'=>$cid];

                $sql = "SELECT * FROM category WHERE cid= :cid";
                $rows = $database->fetchAll($sql, $parameters);

                $count=0;
                foreach($rows as $row):
                    $count++;
              ?>
                    <tr style="text-align:center;">
                        <td> <?php echo $count;?> </td>
                        <td> <?php echo $row['cname'];?> </td>                   
                        <td align="center"><img src="../images/<?php echo $row['cimage']; ?>" style="max-width: 100px;  max-height: 100px;"></td>            
                        <td>
                             
                            <form action="" method="POST">
                            <input type="hidden" name="cid" value="<?php if(isset($cid)) echo $cid;?>">

                            <input type="submit" name="yes_button" value="Yes" >

                            </form>
                            <a href="category.php" ><input type="submit" value="n o"> </a> 


                            
               
                        </td>
                    
                    </tr>
                <?php endforeach;
                }
                
                else{
                    header('location:category.php');
                }
                
                ?>

    </table>
</body>
</html>