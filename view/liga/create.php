<!DOCTYPE html>
<html lang="de">

<?php
    include('../../include/html.head.inc.php');
showDynamicHtmlHead("Ligen", "navToLigen");
?>

<body>
    <div class="grid-container">
        <?php
        include('../../include/html.body.header.inc.php');
showDynamicHeader("Ligen");
include('../../include/html.body.navigation.inc.php');
?>
        <div class="content">
            <form action="../../controller/liga.php" method="post">
                <div class="card">
                    <div class="card-header">
                        <img class="listIcon" src="./icon/Create.png">
                        Liga anlegen
                    </div>



                    <div class="card-body">

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Sportverband</label>
                            <div class="col-sm-10">
                                <?php
                                include('../../include/dropdown.inc.php');

echo dropdownContent(
    "Sportverbaende"                    //$tableName
    ,
    "SportverbandID"                  //$columnName
    ,
    $_POST['SportverbandID']          //$preselectedValue
    ,
    "ID"                              //$valueColumn
    ,
    "Name"                            //$textColumn
    ,
    "Name"                            //$orderByClause
)
?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Kürzel</label>
                            <div class="col-sm-10">
                                <input type="text" name="ShortCut" class="form-control" value="" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="Name" class="form-control" value="" />
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" name="command" value="create" class="btn btn-success">
                            <img class="listIcon" src="./icon/Create.png">&nbsp;|&nbsp;Anlegen
                        </button>
                        <button type="submit" name="command" value="discardCreate" class="btn btn-secondary">
                            <img class="listIcon" src="./icon/Refresh.png">&nbsp;|&nbsp;Verwerfen
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <?php include('../include/html.body.footer.inc.php');?>
    </div>
</body>

</html>