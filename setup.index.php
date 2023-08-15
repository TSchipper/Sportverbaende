<?php
include('./support/FormBuilder.php');
include('./include/html.head.inc.php');
?>

<body>
    <div class="grid-container">
        <?php
            include('./include/html.body.header.inc.php');
include('./include/html.body.navigation.inc.php');

$body   =   "<div class=\"container\">
                            <div class=\"row\">
                                <div class=\"col\">
                                    <button type=\"submit\" name=\"command\" value=\"loadSportverband\" class=\"btn btn-success\">
                                        <img class=\"listIcon\" src=\"./icon/Refresh.png\" title=\"Beispieldaten für Sportverbände laden\">&nbsp;|&nbsp;Beispieldaten für Sportverbände Laden
                                    </button>
                                    <br>
                                    Beispieldaten für Sportverbände werden in die Datenbank geladen.
                                </div>
                                <div class=\"col\">
                                    <button type=\"submit\" name=\"command\" value=\"resetSportverband\" class=\"btn btn-danger\">
                                        <img class=\"listIcon\" src=\"./icon/Refresh.png\" title=\"Beispieldaten für Ligen zurücksetzen\">&nbsp;|&nbsp;Beispieldaten für Sportverbände Zurücksetzen
                                    </button>
                                    <br>
                                    Beispieldaten für  werden zurückgesetzt.<br>
                                    <b>Ligen werden implizit mit zurückgesetzt!</b>
                                </div>
                                <div class=\"w-100\"><p></p></div>
                                
                                <div class=\"col\">
                                    <button type=\"submit\" name=\"command\" value=\"loadLiga\" class=\"btn btn-success\">
                                        <img class=\"listIcon\" src=\"./icon/Refresh.png\" title=\"Beispieldaten für Ligen laden\">&nbsp;|&nbsp;Beispieldaten für Ligen Laden
                                    </button>
                                    <br>
                                    Beispieldaten für Ligen werden in die Datenbank geladen.<br>
                                    <b>Vorraussetzung: 'Deutscher Fußball-Bund' muss als Sportverband erfasst sein.</b>
                                </div>
                                <div class=\"col\">
                                    <button type=\"submit\" name=\"command\" value=\"resetLiga\" class=\"btn btn-danger\">
                                        <img class=\"listIcon\" src=\"./icon/Refresh.png\" title=\"Beispieldaten für Ligen zurücksetzen\">&nbsp;|&nbsp;Beispieldaten für Ligen Zurücksetzen
                                    </button>
                                    <br>
                                    Beispieldaten für Ligen werden zurückgesetzt.
                                </div>
                              </div>
                        </div>";
echo FormBuilder::buildForm(
    "./setup.controller.php" //$action
    ,
    "post" //$method
    ,
    "./icon/Settings.png" //$headerIcon
    ,
    "Setup" //$headertitle
    ,
    $body //$body
    ,
    null //$footer
    ,
    null //$stdSubmit
    ,
    null //$stdCommand
);

include('./include/html.body.footer.inc.php');
?>
    </div>
</body>

</html>