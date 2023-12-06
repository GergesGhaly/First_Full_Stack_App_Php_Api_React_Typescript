<?php
error_reporting(0);

include "conf.php";


function get_customer(){

global $conn;

    $query="SELECT * FROM `customer`";
    $run_query=mysqli_query($conn,$query);


if($run_query){
if(mysqli_num_rows($run_query) > 0){
$res =mysqli_fetch_all($run_query,MYSQLI_ASSOC);

$data=[
    'status'=> 200,
    'message'=>'Customers Data Found',
    'data'=>$res

];
header('Customers Data Found');
echo json_encode($data);

}else{
    $data=[
        'status'=> 404,
        'message'=>"404 Customer Not Found ",
       
    ];

       header('HTTP/1.0 404 Customer Not Found ');
       echo json_encode($data);
}

}else{
    $data=[
        'status'=> 500,
        'message'=>"500 Server Error ",
       
    ];
    header('HTTP/1.0 500 Server Error ');
    echo json_encode($data);
        
}

}


function get_Single_customer($customerparam){

    global $conn;

 if($customerparam['id'] == null){
     return "Enter Customer id";
    }

    $customerId=mysqli_real_escape_string($conn,$customerparam['id']);
    $query = "SELECT * FROM `customer` WHERE id ='$customerId' LIMIT 1 ";
    $run_query = mysqli_query($conn,$query);

    if($run_query){
        
        if(mysqli_num_rows($run_query) ==1 ){

            $res= mysqli_fetch_assoc($run_query);

            $data=[
                'status'=> 200,
                'message'=> '200 OK',
                'data' => $res
            ];
            header('HTTP/1.0 200 Customers Data Found');
          return  json_encode($data);


        }   else{
            $data=[
                'status'=> 404,
                'message'=> '404 Not Found'
            ];
            header('HTTP/1.0 404 Not Found');
            return  json_encode($data);
    
        }     

    }else{

        $data=[
            'status'=> 500,
            'message'=> '500 Server Error'
        ];
        header('HTTP/1.0 500 Server Error');
        return  json_encode($data);

    }
}



function get_Single_customer_by_name($customerparam){
    global $conn;

    if($customerparam['title'] == null){
        return "Enter Customer title";
       }
   
       $product_title=mysqli_real_escape_string($conn,$customerparam['title']);
       $query = "SELECT * FROM `customer` WHERE title LIKE '%$product_title%'";
       $run_query = mysqli_query($conn,$query);
   
       if($run_query){
           
           if(mysqli_num_rows($run_query) >0 ){
   
               $res= mysqli_fetch_all($run_query,MYSQLI_ASSOC);
   
               $data=[
                   'status'=> 200,
                   'message'=> '200 OK',
                   'data' => $res
               ];
               header('HTTP/1.0 200 Customers Data Found');
             return  json_encode($data);
   
   
           }   else{
               $data=[
                   'status'=> 404,
                   'message'=> '404 Not Found'
               ];
               header('HTTP/1.0 404 Not Found');
               return  json_encode($data);
       
           }     
   
       }else{
   
           $data=[
               'status'=> 500,
               'message'=> '500 Server Error'
           ];
           header('HTTP/1.0 500 Server Error');
           return  json_encode($data);
   
       }
   
}

?>