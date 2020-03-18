<?php
require_once "../../lib/autoload.php";
$apiActions = $Container->getApiActions();
$db = $Container->getDBM();
$uri_parts = explode("/",$_SERVER['REQUEST_URI']);
$count = count($uri_parts);
$last_part = $uri_parts[$count-1];
$previous_part = $uri_parts[$count-2];

if($count == 5 and  $last_part== "taken"){

   if ($_SERVER['REQUEST_METHOD'] == 'GET'){
       $data = $db->GetData("SELECT * from taak");
       echo json_encode($data);
   }
   if ($_SERVER['REQUEST_METHOD']=='POST'){
       $apiActions->addData();
   }


}elseif($count == 6 and $previous_part =="taak"){
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
        $data = $db->GetData("SELECT * from taak where taa_id = '".$last_part."'");
        echo json_encode($data);
    }
    if ($_SERVER['REQUEST_METHOD']=='PUT'){
       $apiActions->updateData($last_part);
    }
    if ($_SERVER['REQUEST_METHOD']=='DELETE'){
        $apiActions->deleteData($last_part);
    }


}else{
    print "Oops! Made a mistake?";
    print "count = $count, previous_part= $previous_part, last_part = $last_part";
}