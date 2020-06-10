<?php
     include 'Models/login_model.php';
     require_once'database.php';  //database.php ko function yo page ma chaine vayera require_once gareko
     $model = new Model();
     session_start();


    if(isset($_POST['login']))
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $username_length=strlen($username);
        $password_length=strlen($password);


        if($username == NULL && $password == NULL) 
        {
            $error_message = "Enter username or password";
        }
        else
        {
           
            if($username_length>=3 && $password_length >= 5 && preg_match('/[A-Z]/', $password)
             && preg_match('/[a-z]/', $password) && preg_match('/[0-9]/', $password) &&  
             preg_match('/[\'^!?$%&*()}{@#~?><>,|=_+?-]/', $password))
            {   

                
                if($row = $model->get_by_username($username,$password))
                {
                  
                        $_SESSION['username']=$username;
                        $_SESSION['active'] = 1; 
                        header('Location:admin.php');
                }
                else

                {?>
                     <script> 
                        alert('Invalid Username and Password!');
                    </script>

         <?php }
                  
   
                
             }

             else
             {
                 if($username_length < 3 )
                 {
                   $user_error="Username must be atleast 3 characters long !";
                 }
                if($password_length < 5)
                 {
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
    }

?>

<!DOCTYPE html>
<html lang="en" style="background-color:#56baed">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Login </title>
</head>
  
    <link rel = "stylesheet" type = "text/css" href="style.css">


<body>
    

<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
      <img src="images/login.png" id="icon" alt="User Icon" />
    </div>

<!-- Login Form -->
    <form method="POST" action="login.php"  onsubmit="return validate();" >

              <label>
                    <input type="text" name="username" id="username" value="<?php if(isset($username)) echo $username ;?>" placeholder="username" autocomplete="off" class = "fadeIn second" required><br>
                    <span id="nameerror"/> 
                    <?php if(isset($user_error)): ?>
                    <p><?php echo $user_error; ?></p>
                    <?php endif; ?>
               
              </label>
              

                <label>
                    <input type="password" name="password" id="password" placeholder="password" autocomplete="off" class="fadeIn third" required><br>
                    <span id="passworderror"/>
                    <?php if(isset($password_error)): ?>
                    <p><?php echo $password_error; ?></p>
                    <?php endif; ?>
                    <?php if(isset($upper_error)): ?>
                    <p><?php echo $upper_error; ?></p>
                    <?php endif; ?>
                </label>
                
                <br><input type="submit" name="login" value="Login" class="fadeIn fourth">          
                     
     </form>  





    <div id="formFooter">
      <a class="underlineHover" href="register.php">Don't have an account ?</a>
    </div>



  </div>
</div>
       
       
        <script src="javascript.js"></script>   

            <?php if(isset($error_message)): ?>
                <p align="center";><?php echo $error_message; ?></p>
                <?php endif; ?> 
</body>
</html>

