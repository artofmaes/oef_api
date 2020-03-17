<?php


class ApiActions
{

    private $pdo;
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }



    public function addData(){
        // voorzie de query voor de database
        $query = 'INSERT INTO taak SET taa_datum = :taa_datum, taa_omschr = :taa_omschr';

        //get de json
        $data = json_decode(file_get_contents('php://input'));


        $stmt = $this->pdo->prepare($query);

        //zijn de veldjes klaar?
        if (!isset($data->taa_datum) or !isset($data->taa_omschr)) {
            print 'Bruh, vul alles eens in';
            die();

        } else {
            $taa_omschr    = htmlentities($data->taa_omschr);
            $taa_datum     = htmlentities($data->taa_datum);
        }

        //bind parameters
        $stmt->bindParam(':taa_omschr', $taa_omschr);
        $stmt->bindParam(':taa_datum', $taa_datum);


        //create new taak in db
        if ($stmt->execute()) echo 'Ding! Taak aangemaakt!';
        else {
            echo $stmt->errorInfo();
            echo 'Oeps! Iets verkeerd gedaan?';
        }
//        global $container;
//        $sql = "INSERT INTO taak SET";
//        if($container->getPDOtoExecute($sql)){
//            return true;
//        }

    }


    public function updateData($id)
    {
//        global $container;
//        $sql = "";
//        if($container->getPDOtoExecute($sql)) return true;

        // voorzie de query voor de database
        $query = 'UPDATE taak SET taa_omschr = :taa_omschr, taa_datum = :taa_datum where taa_id = :taa_id';

        //get de json
        $data = json_decode(file_get_contents('php://input'));


        $stmt = $this->pdo->prepare($query);

        //user input opkuisen
        $taa_id = htmlentities($id);
        $taa_omschr = htmlentities($data->taa_omschr);
        $taa_datum = htmlentities($data->taa_datum);

        //bind parameters
        $stmt->bindParam(':taa_id', $taa_id);
        $stmt->bindParam(':taa_omschr', $taa_omschr);
        $stmt->bindParam(':taa_datum', $taa_datum);

        //update taak in db
        if ($stmt->execute()) echo 'Ding! Taak werd aangepast.';
        else {
            echo $stmt->errorInfo();
            echo 'Oeps! Iets verkeerd gedaan tijdens het updaten?';
        }
    }


    public function deleteData($id){
        // make querry string
        $query = 'DELETE FROM taak where taa_id = :taa_id';

        //prepare statement
        $stmt = $this->pdo->prepare($query);

        //clean user-input
        $taa_id = htmlentities($id);

        //bind parameters
        $stmt->bindParam(':taa_id', $taa_id);

        //delete taak in db
        if ($stmt->execute()) echo 'Ding! Taak werd verwijderd.';
        else {
            echo $stmt->errorInfo();
            echo 'Oeps! Iets verkeerd gedaan tijdens de verwijdering?';
        }
    }


}