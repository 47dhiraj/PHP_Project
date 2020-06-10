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
        <h4>Users</h4>
    </div>
    


<?php
    include '../Models/user_model.php';
    session_start();
    if(!$_SESSION['active'])     
    {
        header('Location: ../login.php');       
    }


include '../sidebar.php';
$model= new Model();
$rows=$model->retrieve_from_users();

?>
<br><br><br>

<div class="searchbox">


<button style="float:left; margin-left: 15px; margin-top:13px;" type="submit" name="add_user"><a href="add_user.php" style="color:white">New User</a></button>

</div>

<table align="center" width="50%"  border="1" style="margin-left:450px; margin-top: 100px;">
        <tr>
			<th>S.N</th>
			<th>Image</th>  
            <th>User</th>
            <th>Address</th>
            <th>Contact</th>
            <th>Action</th>
        </tr>

        <?php
        
        if(count($rows)==0)
                 {
                    echo "<tr ><td align='center' colspan='12'> Sorry!!  No Users !!</td></tr>";
                 }
        
            else{

                    $count=0;
                    foreach($rows as $row):
                        $count++;
        ?>
                        <tr style="text-align:center;">
                            <td> <?php echo $count;?> </td>
							<td style="width:100px; height: 96px;" align="center"><img src="../images/<?php echo $row['image']; ?>" style="width:95px; height: 136px;"></td>          
                            <td> <?php echo $row['username'];?> </td>           
                            <td> <?php echo $row['address'];?> </td>           
                            <td> <?php echo $row['contact'];?> </td>  
                            <td>
                             <a href="user_edit.php?id=<?php echo $row['id'];?>" ><input type="submit" value="  Edit  "></a><br>
               
                             <a href="user_delete.php?id=<?php echo $row['id']; ?>"><input type="submit" value="Delete"></a><br>

                
                             </td>             
                        </tr>
                 <?php endforeach;?>
                
        <?php  } ?>

</table>

</body>
</html>




	
