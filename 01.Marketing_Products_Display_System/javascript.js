function validate()
{
    

    var nameerror= "";
    var passworderror= ""; 
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;

    if(username == "" && password == ""){
        document.getElementById("nameerror").innerHTML = " Please enter your name ";
        document.getElementById("passworderror").innerHTML='Please enter your password';   
        return false;  
    }
       
    if(username.length<3 && password == "")
    {
        document.getElementById("nameerror").innerHTML="Username must be 3 characters long";
        document.getElementById("passworderror").innerHTML='Please enter your password';   
        return false;     
    }

    else
    {
        document.getElementById("nameerror").innerHTML = "";
        document.getElementById("passworderror").innerHTML = "";
    }

    if(username.length>2 && password == "")
    {
        document.getElementById("passworderror").innerHTML='Please enter your password';   
        return false;
    }

    if(username.length>2 && password.length<5){
        document.getElementById("passworderror").innerHTML='Password must be 5 characters long';
        return false; 
    } 

    if(password== "")
    {
        document.getElementById("passworderror").innerHTML='Please enter your password'; 
        return false;
    }
    
    if(username.length<2 && password.length<5){
        document.getElementById("nameerror").innerHTML="Username must be 3 characters long";
        document.getElementById("passworderror").innerHTML='Password must be 5 characters long';
        return false;
    }
    
    let nameformat = /^[a-zA-Z0-9_ ]{3,}$/;
    if(nameformat.test(username) === false) {
        document.getElementById("passworderror").innerHTML=' ';
        document.getElementById("nameerror").innerHTML = 'Please enter a valid name';
        return false;
    } 

    if(password.length<5){
        document.getElementById("nameerror").innerHTML = ' ';
        document.getElementById("passworderror").innerHTML='Password must be 5 characters long';
        return false;
    } 

    var passformat= /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[_!@#\$%\^&\*])(?=.{5,})/;
    if(passformat.test(password) === false)
    {
        document.getElementById("nameerror").innerHTML = ' ';
        document.getElementById("passworderror").innerHTML='Password must have at least one uppercase,one lowercase and a symbol';
        return false;
    }

    document.getElementById("nameerror").innerHTML = "";
    document.getElementById("nameerror").innerHTML = "";


    
}

