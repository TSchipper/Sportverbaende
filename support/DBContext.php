<?php

//Quelle: php-einfach, //https://github.com/hungnttg/PHP/blob/master/DBController.php
//- Dann: Nach eigenen Überlegungen erstellt, zwecks
//- Konfigurierbarkeit des ConnectionStrings per Datei
//- Konsequente Nutzung von prepare gegen SQL-Injection und Stabilität von Transaktionen

include('./support/ConfigFile.php');

class DBContext
{
    private $configFile;

    private $host;
    private $masterDatabase;
    private $appDatabase;
    private $user;
    private $password;

    private $pdo;

    private function connectToMasterDatabase()
    {
        $this->pdo = null;
        $hostDatabase       = 'mysql:host='.$this->host.';dbname='.$this->masterDatabase.'';
        $this->pdo = new PDO($hostDatabase, $this->user, $this->password);
    }

    private function connectToAppDatabase()
    {
        $this->pdo = null;
        $hostDatabase       = 'mysql:host='.$this->host.';dbname='.$this->appDatabase.'';

        $this->pdo = new PDO($this->hostDatabase, $this->user, $this->password);

    }
    private function disconnectDatabase()
    {
        $this->pdo = null;
    }

    private function appDatabaseExisting()
    {
        $this->connectToMasterDatabase();
        $sqlCommand = "SHOW DATABASES";
        foreach ($this->pdo->query($sqlCommand) as $row) {
            if ($row['Database'] == $this->appDatabase) {
                return true;
            }
        }
        /*
                $sqlCommand     = "SHOW DATABASES";
                $statement = $this->pdo->prepare($sqlCommand);
                $databases = $statement->execute();

                foreach ($databases as $database) {

        if ($row['Database'] == $this->appDatabase) {
            return true;
        }
        */
        return false;
    }

    private function createAppDatabase()
    {
        $this->connectToMasterDatabase();
        $sqlCommand = 'CREATE DATABASE '.$this->appDatabase;
        $statement = $this->pdo->prepare($sqlCommand);
        $statement->execute();
        $this->disconnectDatabase();
    }

    private function createDataBaseStructures()
    {
        $this->exeuteSqlScript("./data/dataModel/createDataBaseStructures.sql");
    }

    public function __construct()
    {
        /*
        $this->configFile         = new ConfigFile('./settings/ConnectionString.config');
        $configFilePathAndName = './settings/ConnectionString.config';

        $this->host               = $this->configFile->getConfigSetting($configFilePathAndName, 'host');
        echo "host: ".$this->configFile->getConfigSetting($configFilePathAndName, 'host');

        $this->masterDatabase     = $this->configFile->getConfigSetting($configFilePathAndName, 'masterDatabase');
        echo "masterDatabase: ".$this->configFile->getConfigSetting($configFilePathAndName, 'masterDatabase');

        $this->appDatabase        = $this->configFile->getConfigSetting($configFilePathAndName, 'appDatabase');
        echo "appDatabase: ".$this->configFile->getConfigSetting($configFilePathAndName, 'appDatabase');

        $this->user               = $this->configFile->getConfigSetting($configFilePathAndName, 'user');
        echo "user: ".$this->configFile->getConfigSetting($configFilePathAndName, 'user');

        $this->password           = $this->configFile->getConfigSetting($configFilePathAndName, 'password');
        echo "password: ".$this->configFile->getConfigSetting($configFilePathAndName, 'password');
        */
        $this->host               = "localhost";
        $this->masterDatabase     = "mysql";
        $this->appDatabase        = "sportverbaende";
        $this->user               = "root";
        $this->password           = null;


        if (!$this->appDatabaseExisting()) {
            $this->createAppDatabase();
            $this->createDataBaseStructures();
        }
    }

    /*
        public static function getObjects($dbContext, $whereClause, $orderByClause)
        {
        }
    */

    public function exeuteSqlScriptFile($scriptFile)
    {
        $this->connectToAppDatabase();
        //https://www.php-resource.de/forum/php-developer-forum/88291-sql-datei-per-php-ausf%C3%BChren
        $fileContent = file_get_contents($scriptFile);
        $sqlCommands = explode(';', $fileContent);

        foreach($sqlCommands as $sqlCommand) {
            if ($sqlCommand != null and $sqlCommand !="" and !str_contains($sqlCommand, "--")) {
                $statement          =   $this->pdo->prepare($sqlCommand);

                $statement->execute();// || die("Error: " . mysql_error() . "<br />Cmd: $cmd<br />");
            }
        }
        $this->disconnectDatabase();
    }

    private function createRecord($sqlCommand)
    {
        $this->connectToAppDatabase();

        $statement      =   $this->pdo->prepare($sqlCommand);
        $statement->execute(array());
        $newID = $this->pdo->lastInsertId();
        $this->disconnectDatabase();
        return $newID;
    }

    private function updateRecord($sqlCommand)
    {
        $this->connectToAppDatabase();
        $statement      =   $this->pdo->prepare($sqlCommand);
        $statement->execute(array());
        $this->disconnectDatabase();
    }

    private function deleteRecord($sqlCommand)
    {
        $this->connectToAppDatabase();
        $statement      =   $this->pdo->prepare($sqlCommand);
        $statement->execute(array());
        $this->disconnectDatabase();
    }

    private function returnRecordset($sqlCommand, $pageSize, $pageNumber)
    {
        $this->connectToAppDatabase();
        if (isset($pageSize)) {
            if (!isset($pageNumber) or $page < 1) {
                $pageNumber = 1;
            }
            $limitStart = ($pageNumber - 1) * $pageSize;
        }
        $statement      =   $this->pdo->prepare($sqlCommand);
        $result         =   $statement->execute(array());

        //LIMIT 5, 3 --> starte bei 5 und gehe 3 weiter = 5 bis 8
        $this->disconnectDatabase();
        return $result;
    }

    /*
    private function returnValue($sqlCommand)
    {

    }
    */
}
