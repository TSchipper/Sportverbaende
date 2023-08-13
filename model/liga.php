<?php

class Liga extends basic
{
    public $sportVerbandID;
    public $Sportverband;

    public function __construct($ID, $DisplayName, $sportVerbandID, $Sportverband, $ShortCut, $Name)
    {
        $this->id               =       $ID;
        $this->DisplayName      =       $DisplayName;
        $this->sportVerbandID   =       $sportVerbandID;
        $this->Sportverband     =       $Sportverband;
        $this->ShortCut         =       $ShortCut;
        $this->Name             =       $Name;
    }

    public static function listCount($dbContext, $whereClause)
    {
        return ($dbContext->numRows("SELECT * FROM ligen ".$whereClause));
    }

    public static function getObjects($dbContext, $whereClause, $orderByClause)
    {
        $resultSet = array();

        $_ligen = array();

        $sqlCommand = "SELECT * FROM Ligen_Presentation ".$whereClause." ".$orderByClause;
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
        $sqlCommand = "SELECT * FROM Ligen_Presentation WHERE ID = ".$ID;

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
        //https://www.w3schools.com/php/php_mysql_insert_lastid.asp
        $sqlCommand       =   "INSERT INTO ligen (SportverbandID, ShortCut, Name) VALUES ('".$object->sportverbandID."', '".$object->ShortCut."', '".$object->name.")";
        return $dbContext->insert($sqlCommand);
    }

    public static function update($dbContext, $object)
    {
        $sqlCommand         =   "UPDATE ligen SET SportverbandID = ".$object->sportVerbandID.", ShortCut = '".$object->ShortCut."', Name = '".$object->name."' WHERE ID = ".$object->id;
        $dbContext->execute($sqlCommand);
    }

    public static function delete($dbContext, $ID)
    {
        $sqlCommand         =   "DELETE FROM ligen WHERE ID = ".$ID;
        $dbContext->execute($sqlCommand);

    }

    #-------------------------------------------------------------------------------
    # html-Visualisierung von Ligen
    #-------------------------------------------------------------------------------
    public function object2cardBody($dbContext)
    {
        $selectControl =        basic::dropdownContent(
            $dbContext                        //$dbContext
            ,
            "Sportverbaende"                //$tableName
            ,
            "SportverbandID"                  //$columnName
            ,
            $this->sportVerbandID           //$preselectedValue
            ,
            "ID"                              //$valueColumn
            ,
            "Name"                            //$textColumn
            ,
            "Name"                            //$orderByClause
        );
        return (
            "<input type=\"hidden\" name=\"ID\" value=\"".$this->id."\"/>
        <div class=\"form-group row\">
            <label class=\"col-sm-2 col-form-label\">Sportverband</label>
                <div class=\"col-sm-10\">".$selectControl."</div>
        </div>

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
        </div>"
        );
    }
    #-------------------------------------------------------------------------------
}
