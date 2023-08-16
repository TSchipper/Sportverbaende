<?php

class Sportverband extends basic
{
    public $NumberOfMembers;

    public function __construct($ID, $DisplayName, $ShortCut, $Name, $NumberOfMembers)
    {
        $this->ID               =       $ID;
        $this->DisplayName      =       $DisplayName;
        $this->ShortCut         =       $ShortCut;
        $this->Name             =       $Name;
        $this->NumberOfMembers  =       $NumberOfMembers;
    }

    public static function getObjects($dbContext, $whereClause, $orderByClause)
    {
        $resultSet = array();
        $_sportverbaende = array();
        //mnb: abstrahieren auf ClassName
        $sqlCommand = "SELECT * FROM Sportverband_presentation".$whereClause." ".$orderByClause;
        $resultSet  = $dbContext->returnRecordset($sqlCommand);

        if ($resultSet != null) {
            foreach ($resultSet as $row) {
                $ID =  $row['ID'];
                $DisplayName =  $row['DisplayName'];
                $ShortCut =  $row['ShortCut'];
                $Name =  $row['Name'];
                $NumberOfMembers =  $row['NumberOfMembers'];

                $_sportverband = new Sportverband($ID, $DisplayName, $ShortCut, $Name, $NumberOfMembers);
                $_sportverbaende[]=$_sportverband;
            }
        }

        return $_sportverbaende;
    }

    public static function getObjectByID($dbContext, $ID)
    {
        //mnb: abstrahieren auf ClassName
        $sqlCommand = "SELECT * FROM Sportverband_presentation WHERE ID = ".$ID;

        foreach ($dbContext->returnRecordset($sqlCommand) as $row) {
            $DisplayName =  $row['DisplayName'];
            $ShortCut =  $row['ShortCut'];
            $Name =  $row['Name'];
            $NumberOfMembers =  $row['NumberOfMembers'];

            $_sportverband = new Sportverband($ID, $DisplayName, $ShortCut, $Name, $NumberOfMembers);
        }
        return $_sportverband;
    }

    public static function create($dbContext, $object)
    {
        //mnb: abstrahieren auf ClassName
        $sqlCommand       =   "INSERT INTO Sportverband (ShortCut, Name, NumberOfMembers) VALUES ('".$object->ShortCut."', '".$object->Name."', ".$object->NumberOfMembers.")";
        return $dbContext->createRecord($sqlCommand);
    }

    public static function update($dbContext, $object)
    {
        //mnb: abstrahieren auf ClassName
        $sqlCommand         =   "UPDATE Sportverband SET ShortCut = '".$object->ShortCut."', Name = '".$object->Name."', NumberOfMembers = ".$object->NumberOfMembers." WHERE ID = ".$object->ID;
        $dbContext->updateRecord($sqlCommand);
    }
}
