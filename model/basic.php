<?php

class basic
{
    public $ID;
    public $DisplayName;
    public $ShortCut;
    public $Name;

    #Generische Funktion für dynamische Erstellung von Select-Inputs
    public static function dropdownContent(
        $dbContext,
        $tableName,
        $columnName,
        $preselectedValue,
        $valueColumn,
        $textColumn,
        $orderByClause
    ) {

        $sqlCommand         =       "SELECT ".$valueColumn." AS ValueColumn, ".$textColumn." AS TextColumn FROM ".$tableName." ORDER BY ".$orderByClause;

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

    public static function objects2thead($fieldSettings, $includeSuperiorContext)
    {
        $result = "";
        if ($fieldSettings != null) {

            foreach ($fieldSettings->getFieldSettings() as $fieldSetting) {

                if (($fieldSetting->_sortOrder == "Asc") or ($fieldSetting->_sortOrder == "Desc")) {
                    $visiblity  = 'visible';
                } else {
                    $visiblity  = 'invisible';
                }
                $sortOrder  =   $fieldSetting->_sortOrder;
                $sortRank   =   $fieldSetting->_sortRank;

                $result     .=  "<th>
                                    <div class=\"container\">
                                        <div class=\"row\">
                                            <div class=\"col\">
                                                <u>".$fieldSetting->_displayName."</u></div>
                                            <div class=\"col-1\">
                                                <img src=\"./icon/Sort_".$sortOrder.".png\" class=\"listIcon ".$visiblity."\">
                                            </div>
                                            <div class=\"col-1\">
                                                <img src=\"./icon/Digit_0".$sortRank."_Circle.png\" class=\"listIcon ".$visiblity."\">
                                            </div>
                                        </div>
                                    </div>
                                </th>";
            }
        }
        return "<thead><tr>".$result."</tr></thead>";
    }

    public static function object2tr($fieldSettings, $includeSuperiorContext, $object)
    {
        $result            =   "<tr>
			                        <td class=\"tableCell_Icon\">
                                        <span style=\"white-space: nowrap;\">
                                            <input type=\"checkbox\"/>
                                            <a href=\"Sportverband.controller.php?id=".$object->ID."\">
                                                <img class=\"listIcon\" src=\"./icon/Edit.png\" title=\"Bearbeiten\">
                                            </a>
                                            <img class=\"listIcon\" src=\"./icon/Duplicate.png\" title=\"Duplizieren (Mockup)\">
                                            <img class=\"listIcon\" src=\"./icon/Delete.png\" title=\"Löschen\" onClick=\"activateDeleteConfirmation (".$object->ID.", '".$object->DisplayName."')\"/>
                                        </span>    
	                                </td>";
        if ($fieldSettings != null) {
            foreach ($fieldSettings->getFieldSettings() as $fieldSetting) {
                if ($fieldSetting->_showInOverview) {
                    $result .=       "<td class=\"tableCell_Text\">".$object->{$fieldSetting->_columnName}."</td>";
                    //<td class=\"tableCell_Text\">".number_format($this->NumberOfMembers, 0, "", ".")."</td>
                }
            }
        }
        return $result."</tr>";
    }

    public static function objects2tbody($fieldSettings, $includeSuperiorContext, $objects)
    {
        $tableRows  =       "";
        foreach ($objects as $object) {
            $tableRows  .=      $object->object2tr($fieldSettings, $includeSuperiorContext, $object);
        }
        return ("<tbody>".$tableRows."</tbody>");
    }

    public static function objects2table($fieldSettings, $includeSuperiorContext, $objects)
    {
        $table      =       "<table class=\"table table-light table-striped table-hover\">";

        $table      .=          self::objects2thead($fieldSettings, $includeSuperiorContext);
        $table      .=          self::objects2tbody($fieldSettings, $includeSuperiorContext, $objects);


        $table      .=      "</table>";
        return      $table;
    }
}
