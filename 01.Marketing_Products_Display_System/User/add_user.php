<?php

session_start();
    if(!$_SESSION['active'])     
    {
        header('Location: ../login.php');       
    }
    

    require_once '../Models/signup_model.php';
    require_once '../database.php';






    if(isset($_REQUEST['signup_button']))
        {
            $username=$_REQUEST['username'];
            $password=$_REQUEST['password'];
            $Re_password=$_REQUEST['Re_password'];

            $username_length=strlen($username);
            $password_length=strlen($password);
            
            $address=$_REQUEST['address'];
            $contact=$_REQUEST['contact'];


            $image = $_FILES['image']['name'];
    	    $tempname = $_FILES['image']['tmp_name'];

    	    move_uploaded_file($tempname, "../images/$image");
            // $_SESSION['user_active'] = 1; 


            try{
                if($username !=NULL && $password != NULL && $Re_password != NULL && $username_length>=3 && $password_length >= 5 && preg_match('/[A-Z]/', $password)
                && preg_match('/[a-z]/', $password) && preg_match('/[0-9]/', $password) &&  
                preg_match('/[\'^!?$%&*()}{@#~?><>,|=_+?-]/', $password))   
                //user and password valdation check gareko i.e khali chaina vane matra if vitra ko code run gareko
                    {
                     
                     if($password == $Re_password)
                        {
                            $_SESSION['active'] = 1; 
                            $model=new Model();  //user_model ma UserModel vanni class cha tesaiko object banayeko ho.
                            $model->user_signup($username,$password,$address,$contact,$image);  
                            header('Location: users.php'); //users.php ma redirect gareko
                        }   
                        else
                            {
                                  $error_msg= "Wrong attempt! Password did not matched.";
                            }
                    }

                else
                {
                    if($username_length < 3 ){
                        $user_error="Username must be atleast 3 characters ..";
                     }
                     if($password_length < 5){
                        $password_error="Password must be atleast 5 characters..";
                      }
                      elseif(!preg_match('/^[A-Z]/',$password) or !preg_match('/^[a-z]/',$password) or !preg_match('/[0-9]/', $password) or !preg_match('/^[\'^!�$%&*()}{@#~?><>,|=_+�-]/', $password) )
                      {
     
                      $upper_error="At least one uppercase ,one lowercase and one punctuation character required in password . ";
                     }
                     else
                     {
                         echo "";
                     }
                   
                }
                    

            }
            catch(PDOException $e){
            ?>
          
                <script>
                     alert('<?php echo "User already exists. Please! Try with different username.";?>');
                     window.open('add_user.php', '_self');
                </script>

<?php 
            }
          

        }
    

?>


<!DOCTYPE html>
<html>

<head>
	<title>New User Registration</title>

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
    <h4>New User Registration</h4>
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
    

<div style="margin-left:625px; margin-top:150px;" id="formContent"> 



<form align="center" method="POST" action="add_user.php" enctype="multipart/form-data">
            
            Username:
            <input type="text" name="username" placeholder="Enter Username" required>
            <?php if(isset($user_error)): ?>
                <p><?php echo $user_error; ?></p>
                <?php endif; ?>
            <br><br>

            
            Password:   
            <input type="password" name="password" placeholder="Enter Password" required>
            <?php if(isset($password_error)): ?>
                    <p><?php echo $password_error; ?></p>
                    <?php endif; ?>
                    <?php if(isset($upper_error)): ?>
                    <p><?php echo $upper_error; ?></p>
                    <?php endif; ?>
            <br><br>

            Re-pswd:    
            <input type="password" name="Re_password" placeholder="Retype password"  required><br><br>

            Address:    
            <input type="text" name="address" placeholder="Enter address" required><br><br>

            Contact:    
            <input type="text" name="contact" placeholder="phone number" required><br><br>

            Image:  
            <input type="file" id="image" name="image"><br><br>



            <input type="submit" name="signup_button" value="Signup"><br>
           

        </form>

</div>

<?php if(isset($error_msg)): ?>

<script>
    alert('<?php echo $error_msg; ?>');
    window.open('add_user.php', '_self');
</script>

<?php endif; ?>

</body>
</html>

