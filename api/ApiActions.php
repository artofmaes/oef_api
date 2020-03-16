<?php


class ApiActions
{
 public function GetData( $sql )
 {
     $dsn = "mysql:host=localhost;dbname=php2stedensteven";
     $user = "root";
     $passwd = "Xrkwq349";

     $pdo = new PDO($dsn, $user, $passwd);

     $stm = $pdo->prepare($sql);
     $stm->execute();

     $rows = $stm->fetchAll(PDO::FETCH_ASSOC);
     return json_encode($rows);

 }
}