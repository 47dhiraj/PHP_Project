<?php



// yaha tala vayeko sabbai function hami aafaile hamro ichya le kaam garna ko lagi banayeko function haru ho
class Model
{
    function get_by_username($username, $password)
    {
        $database= new Database();     

        $parameters=[                  
            'username'=> $username,
            'password'=> $password
        ];

        $sql = 'select * from users where username = :username AND password = md5(:password)';
        $row= $database->fetchAll($sql,$parameters);  

        if(count($row)==0)
            return NULL;
 
        return $row[0]; //array ko rup ma return auncha and tyo id gareko item ta yeuta matrai nai ta huncha so array ko index first nia return gadeko

    }


}