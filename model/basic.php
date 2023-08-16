<?php

class basic
{
    public $ID;
    public $DisplayName;
    public $ShortCut;
    public $Name;

    #-------------------------------------------------------------------------------
    # html-Visualisierung von Ligen
    #-------------------------------------------------------------------------------

    #Generische Funktion für dynamische Erstellung von Select-Inputs

    public static function dropdownContent(
        $dbContext,
        $tableName,
        $columnName,
        $preselectedValue,
        $valueColumn,
        $textColumn
    ) {

        $sqlCommand         =       "SELECT ".$valueColumn." AS ValueColumn, ".$textColumn." AS TextColumn FROM ".$tableName."_Presentation ORDER BY ".$textColumn;

        $dropdownContent    =       "<select name=\"".$columnName."\" class=\"form-control\">";

        foreach ($dbContext->execute($sqlCommand) as $row) {
            $newOption      =       "";
            if (isset($preselectedValue) and $preselectedValue == $row['ValueColumn']) {
                $newOption  .=      "<option value=\"".$row['ValueColumn']."\" selected=\"selected\">".$row['TextColumn']."</option>";
            } else {
                $newOption  .=      "<option value=\"".$row['ValueColumn']."\">".$row['TextColumn']."</option>";
            };
            $dropdownContent
                            .=      $newOption;
        }
        $dropdownContent    .=      "</select>";
        return                      $dropdownContent;
    }

    #Generische Funktion für die Erstellung von Objektübersichten
    public static function objects2thead($fieldSettings)
    {
        $result = "";
        if ($fieldSettings != null) {

            foreach ($fieldSettings->getFieldSettings() as $fieldSetting) {
                if ($fieldSetting->_showInOverview or $fieldSetting->_columnName =="ID") {
                    if (($fieldSetting->_sortOrder == "Asc") or ($fieldSetting->_sortOrder == "Desc")) {
                        $visiblity  = 'visible';
                    } else {
                        $visiblity  = 'invisible';
                    }
                    $sortOrder      =   $fieldSetting->_sortOrder;
                    if (is_null($sortOrder)) {
                        $sortOrder = "asc";
                    }

                    $sortRank       =   $fieldSetting->_sortRank;
                    if (is_null($sortRank)) {
                        $sortRank = "1";
                    }

                    $thContent      =   "<form>
                                            <table width=\"100%\"border = \"0\">
                                                <tr>
                                                    <td align=left>
                                                        <button type=\"button\" class=\"btn btn-secondary\">".$fieldSetting->_displayName."</button>
                                                    </td>
                                                </tr>
                                            </table>
                                        </form>";
                    if ($fieldSetting->_columnName != "ID") {
                        $thContent  =   "<form action=\"\" method=\"Post\">
                                            
                                            <input type=\"hidden\" name=\"ClassName\" value=\"".$fieldSetting->_className."\" />
                                            <input type=\"hidden\" name=\"ColumnName\" value=\"".$fieldSetting->_columnName."\" />

                                            <table width=\"100%\"border = \"0\">
                                                <tr>
                                                    <td align=left>
                                                        <button type=\"submit\" name=\"command\" value=\"setSortOrder\" class=\"btn btn-secondary\">"
                                                            .$fieldSetting->_displayName.
                                                        "</button>
                                                    </td>
                                                    <td align=right width=\"2em\">
                                                        <button type=\"submit\" name=\"command\" value=\"removeSortOrder\" class=\"btn btn-secondary ".$visiblity."\">
                                                            <img src=\"./icon/Sort_".$sortOrder.".png\" class=\"listIcon ".$visiblity."\">
                                                        </button>
                                                    </td>
                                                    <td align=right width=\"2em\">
                                                        <button type=\"submit\" name=\"command\" value=\"removeSortOrder\" class=\"btn btn-secondary ".$visiblity."\">
                                                            <img src=\"./icon/Digit_0".$sortRank."_Circle.png\" class=\"listIcon ".$visiblity."\">
                                                        </button>
                                                    </td>
                                                </tr>
                                            </table>
                                        </form>";
                    }
                    $result     .=  "<th nowrap class=\"tableCell_Icon\">".$thContent."</th>";
                }
            }
        }
        return "<thead><tr>".$result."</tr></thead>";
    }

    public static function object2tr($fieldSettings, $object)
    {
        $result            =   "<tr>
			                        <td class=\"tableCell_Icon\">
                                        <span style=\"white-space: nowrap;\">
                                            <input class=\"listIcon\" type=\"checkbox\"/>
                                            <a href=\"".get_Class($object).".controller.php?ID=".$object->ID."\">
                                                <img class=\"listIcon\" src=\"./icon/Edit.png\" title=\"Bearbeiten\">
                                            </a>
                                            <img class=\"listIcon\" src=\"./icon/Duplicate.png\" title=\"Duplizieren (Mockup)\">
                                            <img class=\"listIcon\" src=\"./icon/Delete.png\" title=\"Löschen\" onClick=\"activateDeleteConfirmation (".$object->ID.", '".$object->DisplayName."')\"/>
                                        </span>    
	                                </td>";
        if ($fieldSettings != null) {
            foreach ($fieldSettings->getFieldSettings() as $fieldSetting) {
                if ($fieldSetting->_showInOverview) {
                    switch ($fieldSetting->_dataPresentation) {
                        case    'Integer':
                            $td = "<td class=\"tableCell_Number\">".number_format($object->{$fieldSetting->_columnName}, 0, "", ".")."</td>";
                            break;
                        default:
                            $td = "<td class=\"tableCell_Text\">".$object->{$fieldSetting->_columnName}."</td>";
                            break;
                    }
                    $result .= $td;

                }
            }
        }
        return $result."</tr>";
    }

    public static function objects2tbody($fieldSettings, $objects)
    {
        $tableRows  =       "";
        foreach ($objects as $object) {
            $tableRows  .=      $object->object2tr($fieldSettings, $object);
        }
        return ("<tbody>".$tableRows."</tbody>");
    }

    public static function objects2table($fieldSettings, $objects)
    {
        $table      =       "<table class=\"table table-light table-striped table-hover\">";

        $table      .=          self::objects2thead($fieldSettings);
        $table      .=          self::objects2tbody($fieldSettings, $objects);


        $table      .=      "</table>";
        return      $table;
    }

    #Generische Funktionen für die Erstellung von Objektformularen
    public static function object2createCardBody($dbContext, $fieldSettings, $className)
    {
        $result     =   "";
        if ($fieldSettings != null) {
            foreach ($fieldSettings->getFieldSettings() as $fieldSetting) {
                if ($fieldSetting->_showInForm) {
                    $formGroup  =   "<div class=\"form-group row\">
                                            <label class=\"col-sm-2 col-form-label\">".$fieldSetting->_displayName."</label>
                                            <div class=\"col-sm-10\">";
                    if ($field->_dataPresentation == "Integer") {
                        $formGroup  .=          "<input type=\"number\" name=\"".$fieldSetting->_columnName."\" class=\"form-control\" value=\"\"/>";
                    } elseif (isset($fieldSetting->_selectClass)) {
                        $formGroup  .=          self::dropdownContent(
                            $dbContext,                     //$dbContext
                            $fieldSetting->_selectClass,    //$tableName,
                            $fieldSetting->_columnName,     //$columnName,
                            null,                          //$preselectedValue,
                            "ID",                           //$valueColumn,
                            "DisplayName",                  //$textColumn,
                            "ORDER BY DisplayName"          //$orderByClause
                        );
                    } else {
                        $formGroup  .=          "<input type=\"text\" name=\"".$fieldSetting->_columnName."\" class=\"form-control\" value=\"\"/>";
                    }
                    $formGroup  .=          "</div>
                                        </div>";
                    $result     .=  $formGroup;
                }
            }
        }
        return $result;
    }

    public static function object2editCardBody($dbContext, $fieldSettings, $object)
    {
        $result     =   "<input type=\"hidden\" name=\"ID\" value=\"".$object->ID."\"/>";
        if ($fieldSettings != null) {
            foreach ($fieldSettings->getFieldSettings() as $fieldSetting) {
                if ($fieldSetting->_showInForm) {
                    $formGroup  =   "<div class=\"form-group row\">
                                            <label class=\"col-sm-2 col-form-label\">".$fieldSetting->_displayName."</label>
                                            <div class=\"col-sm-10\">";
                    if (isset($fieldSetting->_selectClass)) {
                        $formGroup  .=          self::dropdownContent(
                            $dbContext,                     //$dbContext
                            $fieldSetting->_selectClass,    //$tableName,
                            $fieldSetting->_columnName,     //$columnName,
                            $object->SportverbandID,        //$preselectedValue,
                            "ID",                           //$valueColumn,
                            "DisplayName",                  //$textColumn,
                            "ORDER BY DisplayName"          //$orderByClause
                        );
                    } else {
                        $formGroup  .=          "<input type=\"text\" name=\"".$fieldSetting->_columnName."\" class=\"form-control\" value=\"".$object->{$fieldSetting->_columnName}."\"/>";
                    }
                    $formGroup  .=          "</div>
                                        </div>";
                    $result     .=  $formGroup;
                }
            }
        }

        return $result;

    }

    public static function listCount($dbContext, $className, $whereClause)
    {
        //echo "SELECT * FROM ".$className." ".$whereClause;
        return $dbContext->numRows("SELECT * FROM ".$className." ".$whereClause);
    }

    public static function delete($dbContext, $object)
    {
        $tableName          =   get_class($object);
        $ID                 =   $object->ID;
        $sqlCommand         =   "DELETE FROM ".$tableName." WHERE ID = ".$ID;
        $dbContext->execute($sqlCommand);
    }
}
