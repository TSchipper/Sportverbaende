<div class="overview">

    <div class="overviewContent">
        <div class="card">
            <div class="card-header">
                Ligen:&nbsp;<?php echo Liga::listCount($dbContext, "");?>&nbsp;(Anzahl)
            </div>
            <div class="card-body">
                <?php echo Liga::objects2table($fieldSettings, true, Liga::getObjects($dbContext, "", $fieldSettings->orderByClause())); ?>
            </div>

            <div class="card-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-1">
                            <a href="./liga.create.php"><img class="listIcon" src="./icon/Create.png"
                                    title="Anlegen"></a>
                        </div>
                        <div class="container col-10 visible">
                            <div class="row">
                                <form action="liga.controller.php" method="post">
                                    <input ID="objectID" type="hidden" name="ID" value="" />
                                    <div class="btn-group invisible" ID="confirmationButtons">
                                        <button ID="confirmationText" type="button" class="btn btn-light">Soll das
                                            Objekt <span ID="spanObjectName" class="objectName"></span> gelöscht
                                            werden?</button>
                                        <button ID="confirmationYes" type="submit" name="command" value="delete"
                                            class="btn btn-danger">Ja</button>
                                        <button ID="confirmationNo" type="button" class="btn btn-secondary"
                                            onClick="deactivateDeleteConfirmation ()">Nein</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>