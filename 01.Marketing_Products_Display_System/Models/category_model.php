<?php

require_once'../database.php';  //database.php ko function yo page ma chaine vayera require_once gareko

// yaha tala vayeko sabbai function hami aafaile hamro ichya le kaam garna ko lagi banayeko function haru ho
class Model
{
    function retrieve_from_category(){

        $database= new Database();
    
        $sql = "SELECT * FROM category";
        $rows= $database->fetchAll($sql);
        return $rows;
    }

    function add_category($cname, $cimage)
    {

        $database=new Database();   

        $parameters=[         
        'cname'=>$cname,
        'cimage'=>$cimage,
        ];

        $sql ='insert into category(cname,  cimage) values(:cname, :cimage)';

        return $database->execute($sql,$parameters);
    }

    Function category_delete($cid)
    {


        $database=new Database();   
        
        $parameters=[               
            'cid'=> $cid
        ];

        $sql ='delete from category where cid= :cid';

        return $database->execute($sql,$parameters);

    }

    function get_cid_by_category($category)
    {
        $database= new Database();     

        $parameters=[                  
            'cname'=> $category
        ];

        $sql = 'select * from category where cname = :cname';
        $row= $database->fetchAll($sql,$parameters);  

        if(count($row)==0)
            return NULL;
 
        return $row[0]; 
    }



    function category_update($cid, $cimage)
    {
        $database=new Database();   
        
        $parameters=[                
        'cid'=> $cid ,
        'cimage'=>$cimage,
        ];

        $sql ="update category set  cimage= :cimage where cid= :cid";

        return $database->execute($sql,$parameters);
    }



    Function get_by_cid($cid)
    {
        $database=new Database();   
        
        $parameters=[                
        'cid'=> $cid 
        ];

        $sql ='select * from category where cid = :cid';

        $row= $database->fetchAll($sql,$parameters);  

        if(count($row)==0)
            return NULL;
 
        return $row[0]; 

    }


}