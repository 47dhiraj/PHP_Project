
<?php

require_once '../database.php';  //database.php ko function yo page ma chaine vayera require_once gareko

// yaha tala vayeko sabbai function hami aafaile hamro ichya le kaam garna ko lagi banayeko function haru ho
class Model
{
        
    function retrieve_from_store(){

    $database= new Database();
    
    $sql = "SELECT * FROM store";
    $rows= $database->fetchAll($sql);
    return $rows;
    }


    
    function retrieve_from_category_by_cid($cid)
    {

        $database= new Database();

        
        $parameters=[                  
            'cid'=> $cid
        ];
    
        $sql = "SELECT * FROM store where cid = :cid";
        $rows= $database->fetchAll($sql, $parameters);
        return $rows;
    }

    function insert($pname, $pprice, $psize, $pimage, $username, $category)
    {
        $database=new Database();   

        $parameters=[         
        'pname'=>$pname,
        'pprice'=>$pprice,
        'psize'=>$psize,
        'pimage'=>$pimage,
        'username'=>$username,
        'cid'=>$category
        ];

        $sql ='insert into store(pname, pprice, psize, pimage, username, cid) values(:pname, :pprice, :psize, :pimage, :username, :cid)';

        return $database->execute($sql,$parameters);
    }

    function get_by_pid($pid)
    {
        $database= new Database();     

        $parameters=[                  
            'pid'=> $pid
        ];

        $sql = 'select * from store where pid = :pid';
        $row= $database->fetchAll($sql,$parameters);  

        if(count($row)==0)
            return NULL;
 
        return $row[0]; //array ko rup ma return auncha and tyo id gareko item ta yeuta matrai nai ta huncha so array ko index first nia return gadeko

    }


    function product_update($pid, $pname, $pprice, $psize, $pimage, $username, $category)
    {
        $database=new Database();   
        
        $parameters=[                
        'pid'=> $pid ,
        'pname'=>$pname,
        'pprice'=>$pprice,
        'psize'=>$psize,
        'pimage'=>$pimage,
        'username'=>$username,
        'cid'=>$category
        ];

        $sql ="update store set pname= :pname, pprice= :pprice, psize= :psize, pimage= :pimage, username= :username, cid= :cid where pid= :pid";

        return $database->execute($sql,$parameters);
    }

    function product_delete($pid)
    {
        $database=new Database();   //Database vanni class ko, $database vanni object banayeko.
        
        $parameters=[               //prepare statement or parameterized 
            'pid'=> $pid
        ];

        $sql ='delete from store where pid= :pid';

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
    
    



}


