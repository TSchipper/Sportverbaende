<?php

class Liga extends basic
{
    public $sportVerbandID;
    public $Sportverband;

    public function __construct($ID, $DisplayName, $SportverbandID, $Sportverband, $ShortCut, $Name)
    {
        $this->ID               =       $ID;
        $this->DisplayName      =       $DisplayName;
        $this->SportverbandID   =       $SportverbandID;
        $this->Sportverband     =       $Sportverband;
        $this->ShortCut         =       $ShortCut;
        $this->Name             =       $Name;
    }

    public static function getObjects($dbContext, $whereClause, $orderByClause)
    {
        $resultSet = array();

        $_ligen = array();
        //mnb: abstrahieren auf ClassName
        $sqlCommand = "SELECT * FROM Liga_presentation ".$whereClause." ".$orderByClause;
        $resultSet  = $dbContext->runQuery($sqlCommand);

        if ($resultSet != null) {
            foreach ($resultSet as $row) {
                $ID =  $row['ID'];
                $DisplayName =  $row['DisplayName'];
                $sportverbandID =  $row['SportverbandID'];
                $Sportverband =  $row['Sportverband'];
                $ShortCut =  $row['ShortCut'];
                $Name =  $row['Name'];

                $_liga = new Liga($ID, $DisplayName, $sportverbandID, $Sportverband, $ShortCut, $Name);

                $_ligen[]=$_liga;
            }
        }
        return $_ligen;
    }

    public static function getObjectByID($dbContext, $ID)
    {
        //mnb: abstrahieren auf ClassName
        $sqlCommand = "SELECT * FROM Liga_presentation WHERE ID = ".$ID;

        foreach ($dbContext->runQuery($sqlCommand) as $row) {
            $DisplayName =  $row['DisplayName'];
            $sportverbandID =  $row['SportverbandID'];
            $Sportverband =  $row['Sportverband'];
            $ShortCut =  $row['ShortCut'];
            $Name =  $row['Name'];

            $_liga = new Liga($ID, $DisplayName, $sportverbandID, $Sportverband, $ShortCut, $Name);

        }
        return $_liga;
    }

    public static function create($dbContext, $object)
    {
        //mnb: abstrahieren auf ClassName
        $sqlCommand       =   "INSERT INTO Liga (SportverbandID, ShortCut, Name) VALUES (".$object->SportverbandID.", '".$object->ShortCut."', '".$object->Name."')";
        echo $sqlCommand;
        return $dbContext->insert($sqlCommand);
    }

    public static function update($dbContext, $object)
    {
        //mnb: abstrahieren auf ClassName

        $sqlCommand         =   "UPDATE Liga SET SportverbandID = ".$object->SportverbandID.", ShortCut = '".$object->ShortCut."', Name = '".$object->Name."' WHERE ID = ".$object->ID;
        $dbContext->execute($sqlCommand);
    }

}
