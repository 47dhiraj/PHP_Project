<?php
session_start();
if(!$_SESSION['active'])     
{
    header('Location: ../login.php');       
}
   
require_once'../database.php';
require_once'../Models/product_model.php';

if(!isset($_POST['yes_button'])) 
{
    $pid = $_GET['pid']; // value from url parameter
}
else 
{
    $pid = $_POST['pid']; // value from hidden field
    
    $model = new Model();

    if($model->product_delete($pid)) 
    {

        header('location: products.php');
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
    <title>Delete</title>
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
        <h4>Delete Form</h4>
    </div>


</div>

<section id="sidebar">
	<nav class="menu">
		<a href="../Category/category.php">Categories</a>
		<a  href="products.php">Products</a>
		<a  href="../User/users.php">Users</a>
		
	</nav>
</section>



    <?php if(isset($error)): ?>
        <p style="color: red"><?php echo $error; ?></p>
    <?php endif; ?>

<br>
    <table align="center" width="50%"  border="1" style="margin-left:450px; margin-top: 150px;">
        <tr >
            <th>S.N</th>
            <th>Product Name</th>
            <th>Price(Rs)</th>
            <th>Size</th>
            <th>Image</th>     
            <th>Delete Sure?</th>     
        </tr>

        <?php
            if(isset($_REQUEST['pid'])){

                $database = new Database();

                $pid = $_REQUEST['pid'];

                $parameters= ['pid'=>$pid];

                $sql = "SELECT * FROM store WHERE pid= :pid";
                $rows = $database->fetchAll($sql, $parameters);

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
                        <td>
                             
                            <form action="" method="POST">
                            <input type="hidden" name="pid" value="<?php if(isset($pid)) echo $pid;?>">

                            <input type="submit" name="yes_button" value="Yes" >

                            </form>
                            <a href="products.php" ><input type="submit" value="n o"> </a> 


                            
               
                        </td>
                    
                    </tr>
                <?php endforeach;
                }
                
                else{
                    header('location:products.php');
                }
                
                ?>

    </table>
</body>
</html>