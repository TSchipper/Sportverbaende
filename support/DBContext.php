<?php

//Quelle: php-einfach, //https://github.com/hungnttg/PHP/blob/master/DBController.php
//- Dann: Nach eigenen Überlegungen erstellt, zwecks
//- Konfigurierbarkeit des ConnectionStrings per Datei
//- Konsequente Nutzung von prepare gegen SQL-Injection und Stabilität von Transaktionen

class DBContext
{
    private $host;
    private $masterDatabase;
    private $appDatabase;
    private $user;
    private $password;

    private $pdo;

    public function __construct()
    {
        $connectionStringFile = file_get_contents('./settings/connectionString.config');
        $connectionStringFileRows = explode(';', $connectionStringFile);

        $connectionSettings = array(
                                "host" => "localhost",
                                "masterDatabase" => "mysql",
                                "appDatabase" => "sportverbaende",
                                "user" => "root",
                                "password" => null);

        foreach($connectionStringFileRows as $connectionStringFileRow) {
            $splitRow = explode('=', $connectionStringFileRow);
            $key =$splitRow[0];
            $value =$splitRow[1];
            $connectionSettings[$key] = $value;
        }

        $this->host               = $connectionSettings["host"];
        $this->masterDatabase     = $connectionSettings["masterDatabase"];
        $this->appDatabase        = $connectionSettings["appDatabase"];
        $this->user               = $connectionSettings["user"];
        $this->password           = $connectionSettings["password"];
        $this->hostDatabase = 'mysql:host='.$this->host.';dbname='.$this->masterDatabase.'';


        $this->pdo = new PDO($this->hostDatabase, $this->user, $this->password);
        if (!$this->appDatabaseExisting()) {
            $this->createAppDatabase();
            $this->switchToAppDatabase();
            $this->createDataBaseStructures();
        }
        $this->switchToAppDatabase();
    }

    private function switchToAppDatabase()
    {
        $this->hostDatabase = 'mysql:host='.$this->host.';dbname='.$this->appDatabase.'';
        $this->pdo = new PDO($this->hostDatabase, $this->user, $this->password);

    }

    private function appDatabaseExisting()
    {
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
    public function exeuteSqlScript($scriptFile)
    {
        //https://www.php-resource.de/forum/php-developer-forum/88291-sql-datei-per-php-ausf%C3%BChren

        $fileContent = file_get_contents($scriptFile);
        $sqlCommands = explode(';', $fileContent);

        foreach($sqlCommands as $sqlCommand) {
            if ($sqlCommand != null and $sqlCommand !="" and !str_contains($sqlCommand, "--")) {
                $statement          =   $this->pdo->prepare($sqlCommand);
                $statement->execute();// || die("Error: " . mysql_error() . "<br />Cmd: $cmd<br />");
            }
        }
    }

    private function createAppDatabase()
    {
        $sqlCommand = 'CREATE DATABASE '.$this->appDatabase;
        $statement = $this->pdo->prepare($sqlCommand);
        $statement->execute();
    }

    private function createDataBaseStructures()
    {
        $this->exeuteSqlScript("./data/dataModel/createDataBaseStructures.sql");
    }
}
