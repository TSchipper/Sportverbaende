<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sportverbände</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/layout.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script src="../../jquery/navigation.js"></script>
    <script src="./jquery/controllerSupport.js"></script>
    <script type="text/javascript">
        window.onload = function() {
            hilightNavItem('navToLigen');
        };
    </script>
</head>

<body>
    <div class="grid-container">
        <div class="header">
            <h1>Ligen</h1>
        </div>

        <?php include('.include(../../include/navigation.inc.php):');?>

        <div class="content">
            <form action="" method="post">
                <div class="card">
                    <div class="card-header">
                        <img class="listIcon" src="./icon/Edit.png" title="Bearbeiten">
                        Sportverband&nbsp;<span class="objectName">
                            <?php echo $shortCut." - ".$name;?>
                        </span>&nbsp;bearbeiten
                    </div>

                    <div class="card-body">
                        <input type="hidden" name="ID"
                            value="<?php echo $id; ?>" />

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Sportverband</label>
                            <div class="col-sm-10">
                                <?php
                                        include('./include/dropdown.inc.php');
        echo dropdownContent(
            "Sportverbaende"                    //$tableName
            ,
            "SportverbandID"                  //$columnName
            ,
            $sportverbandID                   //$preselectedValue
            ,
            "ID"                              //$valueColumn
            ,
            "Name"                            //$textColumn
            ,
            "Name"                            //$orderByClause
        );
        ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Kürzel</label>
                            <div class="col-sm-10">
                                <input type="text" name="ShortCut" class="form-control"
                                    value="<?php echo $shortCut; ?>" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="Name" class="form-control"
                                    value="<?php echo $name; ?>" />
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="row">
                            <div class="btn-group" ID="actionButtons">
                                <button type="submit" name="command" value="save" class="btn btn-success">
                                    <img class="listIcon" src="./icon/Save.png" title="Speichern">&nbsp;|&nbsp;Speichern
                                </button>
                                <button type="submit" name="command" value="discardEdit" class="btn btn-secondary">
                                    <img class="listIcon" src="./icon/Refresh.png"
                                        title="Verwerfen">&nbsp;|&nbsp;Verwerfen
                                </button>
                                <button type="button" ID="btnDelete" onClick="activateDeleteConfirmation ()"
                                    class="btn btn-danger visible">
                                    <img class="listIcon" src="./icon/Delete.png" title="Löschen">&nbsp;|&nbsp;Löschen
                                </button>
                            </div>
                            <div class="btn-group invisible" ID="confirmationButtons">
                                <button ID="confirmationText" type="button" class="btn btn-light">Soll dieses Objekt
                                    gelöscht werden?</button>
                                <button ID="confirmationYes" type="submit" name="command" value="delete"
                                    class="btn btn-danger">Ja</button>
                                <button ID="confirmationNo" type="button" class="btn btn-secondary"
                                    onClick="deactivateDeleteConfirmation ()">Nein</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <?php include('.include(../../include/footernavigation.inc.php):');?>
    </div>
</body>

</html>