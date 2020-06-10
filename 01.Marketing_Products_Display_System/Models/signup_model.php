<?php
// yaha tala vayeko sabbai function hami aafaile hamro ichya le kaam garna ko lagi banayeko function haru ho
class Model
{
    function user_signup($username,$password,$address,$contact,$image)
    {
        $database=new Database();       //Database vanni class ko, $database vanni object banayeko.

        $parameters=[               
        'username'=>$username,
        'password'=>$password,
        'address'=>$address,
        'contact'=>$contact,
        'image'=>$image
        ];  //yo $parameters khas ma list ho jasma key & value xa. 

        $sql ='INSERT INTO users (username, password, address, contact, image) VALUES(:username, md5(:password), :address, :contact, :image)';   
        //mathi password lai md5 le encrypt gareko

        $rows= $database->execute($sql, $parameters);  //fetchAll vanni function call gareko.

        return count($rows) >0;
    }


}