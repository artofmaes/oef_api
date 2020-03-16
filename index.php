<?php
require_once "autoload.php";
$apiActions = $container->getApiActions();
$uri_parts = explode("/",$_SERVER['REQUEST_URI']);
$count = count($uri_parts);
$last_part = $uri_parts[$count-1];
$previous_part = $uri_parts[$count-2];




if($count == 3 and  $last_part== "taken"){

   if ($_SERVER['REQUEST_METHOD'] == 'GET'){
       $data = $container->GetPDOData("SELECT * from taak");
       echo json_encode($data);
   }
   if ($_SERVER['REQUEST_METHOD']=='POST'){
       //add code here

       $data = $apiActions->addData();
       echo "cool, you added something";
       echo json_encode($data);
   }


}elseif($count == 4 and $previous_part =="taak" and is_numeric($last_part)){
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
        $data = $container->GetPDOData("SELECT * from taak where taa_id = '".$last_part."'");
        echo json_encode($data);
    }
    if ($_SERVER['REQUEST_METHOD']=='PUT'){
        //add code here
        $data = $apiActions->updateData();
        echo "cool, you updated something";
        echo json_encode($data);
    }
    if ($_SERVER['REQUEST_METHOD']=='DELETE'){
        //add code here
        $data = $apiActions->deleteData();
        echo "cool, you deleted something";
        echo json_encode($data);
    }


}else{
    print "Oops! Made a mistake?";
    print "count = $count, previous_part= $previous_part, last_part = $last_part";
}