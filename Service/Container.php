<?php


class Container
{
    private $apiActions;
    private $configuration;
    private $pdo;
    private $taak;

    public function __construct(array $configuration){
        $this->configuration = $configuration;
    }

    /**
     * @return PDO
     */
    public function getPDO(){
        if ($this->pdo === null){
            $this->pdo= new PDO(
                $this->configuration['db_dsn'],
                $this->configuration['db_user'],
                $this->configuration['db_pass']
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return $this->pdo;
    }


    public function getPDOData($sql){
        $pdo = $this->getPDO();

        $stm = $pdo->prepare($sql);
        $stm->execute();

        $rows = $stm->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    /**
     * @param $sql
     * @return bool
     */
    public function getPDOtoExecute($sql){
        $pdo = $this->getPDO();

        $stm = $pdo->prepare($sql);

        if ( $stm->execute() ) return true;
        else return false;
    }

    /**
     * @return ApiActions
     */
    public function getApiActions()
    {
        if ($this->taak === null) $this->taak = new ApiActions($this->getPDO());
        return $this->taak;
    }
}