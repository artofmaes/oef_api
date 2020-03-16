<?php


class ApiActions
{

    /**
     * @return boolean
     */
    public function addData(){
        global $container;
        $sql = "INSERT INTO taak SET";
        if($container->getPDOtoExecute($sql)){
            return true;
        }

    }

    /**
     * @return boolean
     */
    public function updateData(){
        global $container;
        $sql = "";
        if($container->getPDOtoExecute($sql)) return true;
    }

    /**
     * @return boolean
     */
    public function deleteData(){
        global $container;
        global $last_part;
        $sql = "DELETE FROM taak where taa_id='$last_part'";
        if($container->getPDOtoExecute($sql)) return true;
    }


}