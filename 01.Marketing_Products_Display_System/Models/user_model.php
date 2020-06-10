<?php

require_once'../database.php';  //database.php ko function yo page ma chaine vayera require_once gareko

// yaha tala vayeko sabbai function hami aafaile hamro ichya le kaam garna ko lagi banayeko function haru ho
class Model
{
        
    function retrieve_from_users()
    {

        $database= new Database();
        
        $sql = "SELECT * FROM users";
        $rows= $database->fetchAll($sql);
        return $rows;
    }
    
    Function get_by_id($id)
    {
        
        $database= new Database();     

        $parameters=[                  
            'id'=> $id
        ];

        $sql = 'select * from users where id = :id';
        $row= $database->fetchAll($sql,$parameters);  

        if(count($row)==0)
            return NULL;
 
        return $row[0];

    }

    Function user_update($id, $username, $password, $address, $contact, $image)
    {
        $database=new Database();   
        
        $parameters=[                
        'id'=> $id ,
        'username'=>$username,
        'password'=>$password,
        'address'=>$address,
        'contact'=>$contact,
        'image'=>$image
        ];

        $sql ="update users set username= :username, password= md5(:password), address= :address, contact = :contact, image= :image  where id= :id";

        return $database->execute($sql,$parameters);

    }
    
    Function user_delete($id)
    {
        $database=new Database();  
        
        $parameters=[               
            'id'=> $id
        ];

        $sql ='delete from users where id= :id';

        return $database->execute($sql,$parameters);

    }

    
}

    
    
    
    
    
    
    