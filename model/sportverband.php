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


    public static function listCount($dbContext, $whereClause)
    {
        return ($dbContext->numRows("SELECT * FROM sportverbaende ".$whereClause));
    }

    public static function getObjects($dbContext, $whereClause, $orderByClause)
    {
        $resultSet = array();
        $_sportverbaende = array();

        $sqlCommand = "SELECT * FROM Sportverbaende_Presentation".$whereClause." ".$orderByClause;
        $resultSet  = $dbContext->runQuery($sqlCommand);

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
        $sqlCommand = "SELECT * FROM Sportverbaende_Presentation WHERE ID = ".$ID;

        foreach ($dbContext->runQuery($sqlCommand) as $row) {
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
        //https://www.w3schools.com/php/php_mysql_insert_lastid.asp
        $sqlCommand       =   "INSERT INTO sportverbaende (ShortCut, Name, NumberOfMembers) VALUES ('".$object->ShortCut."', '".$object->name."', ".$object->NumberOfMembers.")";
        return $dbContext->insert($sqlCommand);
    }

    public static function update($dbContext, $object)
    {
        $sqlCommand         =   "UPDATE sportverbaende SET ShortCut = '".$object->ShortCut."', Name = '".$object->name."', NumberOfMembers = ".$object->NumberOfMembers." WHERE ID = ".$object->id;
        $dbContext->execute($sqlCommand);
    }

    public static function delete($dbContext, $ID)
    {
        $sqlCommand         =   "DELETE FROM sportverbaende WHERE ID = ".$ID;
        $dbContext->execute($sqlCommand);

    }

    #-------------------------------------------------------------------------------
    # html-Visualisierung von Sportverbänden
    #-------------------------------------------------------------------------------
    public function object2cardBody($dbContext)
    {
        return (
            "<input type=\"hidden\" name=\"ID\" value=\"".$this->id."\"/>
        <div class=\"form-group row\">
            <label class=\"col-sm-2 col-form-label\">Kürzel</label>
                <div class=\"col-sm-10\">
                    <input type=\"text\" name=\"ShortCut\" class=\"form-control\" value=\"".$this->ShortCut."\"/>
                </div>
        </div>
        <div class=\"form-group row\">
            <label class=\"col-sm-2 col-form-label\">Name</label>
            <div class=\"col-sm-10\">
                <input type=\"text\" name=\"Name\" class=\"form-control\" value=\"".$this->name."\"/>
            </div>
        </div>
        <div class=\"form-group row\">
            <label class=\"col-sm-2 col-form-label\">Anzahl Mitglieder</label>
            <div class=\"col-sm-10\">
                <input type=\"text\" name=\"NumberOfMembers\" class=\"form-control\" value=\"".$this->NumberOfMembers."\"/>
            </div>
        </div>"
        );
    }
    #-------------------------------------------------------------------------------
}
