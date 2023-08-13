<?php

class FieldSetting
{
    public $_className;
    public $_columnName;
    public $_columnRank;
    public $_displayName;
    public $_selectClass;
    public $_dataPresentation;
    public $_showInOverview;
    public $_showInForm;
    public $_sortOrder;
    public $_sortRank;

    public function __construct($className, $columnName, $columnRank, $displayName, $selectClass, $dataPresentation, $showInOverview, $showInForm, $sortOrder, $sortRank)
    {
        $this->_className           = $className;
        $this->_columnName          = $columnName;
        $this->_columnRank          = $columnRank;
        $this->_displayName         = $displayName;
        $this->_selectClass         = $selectClass;
        $this->_dataPresentation    = $dataPresentation;
        $this->_showInOverview      = $showInOverview;
        $this->_showInForm          = $showInForm;
        $this->_sortOrder           = $sortOrder;
        $this->_sortRank            = $sortRank;
    }

    public function setSortOrder($dbContext, $className, $columnName)
    {
        $sqlCommand = "SELECT NextSortRank FROM FieldSettings_NextSortRankPerClassName WHERE ClassName = '".$className."'";
        //echo $sqlCommand."<br>";
        $nextSortRank   = $dbContext->runQuery($sqlCommand)[0]['NextSortRank'];
        if ($nextSortRank == null) {
            $nextSortRank = 1;
        }
        //echo "Result: ".$nextSortRank."<br>";

        $sqlCommand =   "UPDATE     FieldSettings
                        SET         SortOrder = CASE WHEN (ISNULL (SortOrder) or (SortOrder = 'Desc')) THEN 'Asc' ELSE 'Desc' END
                                    , SortRank = CASE WHEN ISNULL (SortRank) THEN ".$nextSortRank." ELSE SortRank END
                        WHERE       ClassName = '".$this->_className."' AND ColumnName = '".$this->_columnName."'";
        return $dbContext->execute($sqlCommand);
    }

    public function removeSortOrder($dbContext)
    {
        $sqlCommand =   "UPDATE     FieldSettings
                        SET         SortOrder = CASE WHEN ColumnName = '".$this->_columnName."' THEN null ELSE SortOrder END
                                    , SortRank = CASE WHEN SortRank = ".$this->_sortRank." THEN NULL ELSE SortRank - 1 END
                        WHERE       ClassName = '".$this->_className."' AND SortRank >= ".$this->_sortRank;
        return $dbContext->execute($sqlCommand);
    }
}

class FieldSettings
{
    public $_fieldSettings = array();

    public function __construct($dbContext, $className)
    {
        $sqlCommand = "SELECT * FROM FieldSettings WHERE ClassName = '".$className."' ORDER BY ColumnRank";
        $resultSet  = $dbContext->runQuery($sqlCommand);

        if ($resultSet != null) {
            foreach ($resultSet as $row) {

                $className          = $row['ClassName'];
                $columnName         = $row['ColumnName'];
                $columnRank         = $row['ColumnRank'];
                $displayName        = $row['DisplayName'];
                $selectClass        = $row['SelectClass'];
                $dataPresentation   = $row['DataPresentation'];
                $showInOverview     = $row['ShowInOverview'];
                $showInForm         = $row['ShowInForm'];
                $sortOrder          = $row['SortOrder'];
                $sortRank           = $row['SortRank'];

                $_fieldSetting = new FieldSetting($className, $columnName, $columnRank, $displayName, $selectClass, $dataPresentation, $showInOverview, $showInForm, $sortOrder, $sortRank);
                $this->_fieldSettings[]=$_fieldSetting;
            }
        }
    }

    public function getFieldSettings()
    {
        return $this->_fieldSettings;
    }

    public function getFieldSetting($dbContext, $className, $columnName)
    {

        $sqlCommand = "SELECT * FROM FieldSettings WHERE ClassName = '".$className."' AND ColumnName =  '".$columnName."'";
        $resultSet  = $dbContext->runQuery($sqlCommand);

        if ($resultSet != null) {
            $className          = $resultSet[0]['ClassName'];
            $columnName         = $resultSet[0]['ColumnName'];
            $columnRank         = $resultSet[0]['ColumnRank'];
            $displayName        = $resultSet[0]['DisplayName'];
            $selectClass        = $resultSet[0]['SelectClass'];
            $dataPresentation   = $resultSet[0]['DataPresentation'];
            $showInOverview     = $resultSet[0]['ShowInOverview'];
            $showInForm         = $resultSet[0]['ShowInForm'];
            $sortOrder          = $resultSet[0]['SortOrder'];
            $sortRank           = $resultSet[0]['SortRank'];
            return new FieldSetting($className, $columnName, $columnRank, $displayName, $selectClass, $dataPresentation, $showInOverview, $showInForm, $sortOrder, $sortRank);
        }
        return null;
    }

    public function whereClause()
    {
        $result = "";
        return $result;
    }

    public function orderByClause()
    {
        $result = "";
        if ($this->_fieldSettings != null) {
            foreach ($this->_fieldSettings as $fieldSetting) {
                switch ($fieldSetting->_sortOrder) {
                    case 'Asc':     $result .= $fieldSetting->_columnName.", ";
                        break;
                    case 'Desc':    $result .= $fieldSetting->_columnName." DESC, ";
                        break;
                }
            }
        }
        if ($result != "") {
            return "ORDER BY ".substr($result, 0, strlen($result) - 2);
        }
        return ($result);
    }
}
