<?php
require_once "autoload.php";
$apiActions = $container->getApiActions();
//get URL
$uri_parts = explode("/",$_SERVER['REQUEST_URI']);
//COUNT
$count = count($uri_parts);
//Get dif parts
$last_part = $uri_parts[$count-1];
$previous_part = $uri_parts[$count-2];




if($count == 3 and  $last_part== "taken"){
    if($_SERVER['REQUEST_METHOD'] =='GET'){
        $apiActions->GetData("SELECT * from taak");
        return true;
    }
    if($_SERVER['REQUEST_METHOD'] =='POST'){
        $apiActions->CreateData();
        return true;
    }else{
        print "Oops! Made a mistake?";
        print "count = $count, last_part = $last_part";
    }

}elseif($count == 4 and $previous_part =="taak" and is_numeric($last_part)){
    if($_SERVER['REQUEST_METHOD'] =='GET'){
        $apiActions->GetData("SELECT * from taak where taa_id = '".$last_part."'");
        return true;
    }
    if($_SERVER['REQUEST_METHOD'] =='PUT'){
        $apiActions->updateData($last_part);
        return true;
    }if($_SERVER['REQUEST_METHOD'] =='DELETE'){
        $apiActions->deleteData($last_part);
        return true;
    }else{
        print "Oops! Made a mistake?";
        print "count = $count, previous_part= $previous_part, last_part = $last_part";
    }

}