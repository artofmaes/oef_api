<?php


class ApiActions
{

    private $pdo;
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function addData(){

        $data = json_decode(file_get_contents('php://input'));
        //zijn de veldjes klaar?
        if (!isset($data->taa_datum) or !isset($data->taa_omschr)) {
            print 'Bruh, vul alles eens in';
            die();

        } else {
            $taa_omschr    = htmlentities($data->taa_omschr);
            $taa_datum     = htmlentities($data->taa_datum);
        }
        $query = "INSERT INTO taak SET taa_datum = '$taa_datum', taa_omschr = '$taa_omschr'";
        $stmt = $this->pdo->prepare($query);


        if ($stmt->execute()) echo 'Ding! Taak aangemaakt!';
        else {
            echo $stmt->errorInfo();
            echo 'Oeps! Iets verkeerd gedaan?';
        }

    }


    public function updateData($id){

        $data = json_decode(file_get_contents('php://input'));

        $taa_id = htmlentities($id);
        $taa_omschr = htmlentities($data->taa_omschr);
        $taa_datum = htmlentities($data->taa_datum);

        $query = "UPDATE taak SET taa_omschr = '$taa_omschr', taa_datum = '$taa_datum' where taa_id = '$taa_id'";
        $stmt = $this->pdo->prepare($query);

        if ($stmt->execute()) echo 'Ding! Taak werd aangepast.';
        else {
            echo $stmt->errorInfo();
            echo 'Oeps! Iets verkeerd gedaan tijdens het updaten?';
        }
    }


    public function deleteData($id){
        //clean user-input
        $taa_id = htmlentities($id);

        $query = "DELETE FROM taak where taa_id = '$taa_id'";
        $stmt = $this->pdo->prepare($query);
        if ($stmt->execute()) echo 'Ding! Taak werd verwijderd.';
        else {
            echo $stmt->errorInfo();
            echo 'Oeps! Iets verkeerd gedaan tijdens de verwijdering?';
        }
    }


}