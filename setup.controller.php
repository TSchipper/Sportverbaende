<?php

#-------------------------------------------------------------------------------
# Einbindung der benötigten  Modelle
#-------------------------------------------------------------------------------
include("./model/basic.php");
include("./support/exeuteSqlScript.php");
#-------------------------------------------------------------------------------

#-------------------------------------------------------------------------------
# Ausführung des Controllers
#-------------------------------------------------------------------------------

$title = "Setup";
$navElement = "navToSetup";
include('.//setup.index.php');

function loadSportverband()
{
    exeuteSqlScript("./data/dataSamples/loadSportverband.sql");
}

function resetSportverband()
{
    exeuteSqlScript("./data/dataSamples/resetSportverband.sql");
    exeuteSqlScript("./data/dataModel/dataBaseStructures.sql");
}

function loadLiga()
{
    exeuteSqlScript("./data/dataSamples/loadLiga.sql");
}

function resetLiga()
{
    exeuteSqlScript("./data/dataSamples/resetLiga.sql");
}

if (isset($_POST['command'])) {
    switch ($_POST['command']) {
        case 'loadSportverband':
            loadSportverband();
            break;
        case 'resetSportverband':
            resetSportverband();

            break;
        case 'loadLiga':
            loadLiga();
            break;
        case 'resetLiga':
            resetLiga();
            break;
    }
}
