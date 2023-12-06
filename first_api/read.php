<?php

header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Method: GET");
header("Content-Type:application/json");
header("Access-Control-Allow-Headers:Content-Type,Access-Control-Allow-Headers,Authorizition,X-Request-With");
include "func_get_customer.php";


 $Request_Method =$_SERVER["REQUEST_METHOD"] ;

if($Request_Method == "GET"){


if(isset($_GET['id'])){

    echo get_Single_customer($_GET);
} 
elseif(isset($_GET['title'])){
        
        
    echo get_Single_customer_by_name($_GET);
  
  }
  
  
else{

    echo get_customer();

}

}else{


    $data=[
        'status'=> 405,
        'message'=> $Request_Method. ' Method Not Allow',
    ];
    header("HTTP/1.0 405 Method Not Allow");
    echo json_encode($data);

}



?>