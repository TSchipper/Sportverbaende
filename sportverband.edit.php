<?php
$title = "Sportverbände";
$navElement = "navToSportverband";
include('./include/html.head.inc.php');
?>

<body>
    <div class="grid-container">
        <?php
        include('./include/html.body.header.inc.php');
include('./include/html.body.navigation.inc.php');
?>
        <div class="content">
            <form action="./sportverband.controller.php" method="post">
                <div class="card">
                    <div class="card-header">
                        <img class="listIcon" src="./icon/Edit.png" title="Bearbeiten">
                        Sportverband&nbsp;<span class="objectName">
                            <?php echo $object->DisplayName; ?>
                        </span>&nbsp;bearbeiten
                    </div>

                    <div class="card-body">
                        <?php echo basic::object2editCardBody($dbContext, $fieldSettings, $object);?>
                    </div>

                    <div class="card-footer">
                        <?php include("./include/html.body.object.edit.footer.inc.php");?>
                    </div>
                </div>
            </form>
            <p></p>
            <div class="card">
                <div class="card-header">
                    Ligen des Sportverbands&nbsp;
                    <span class="objectName">
                        <?php echo $object->DisplayName; ?>
                    </span>
                    Anzahl:
                    <!-- mnb: warum geht der Müll hier nicht??? -->
                    <?php Liga::listCount($dbContext, "Liga", "WHERE ".get_class($object)."ID = ".$object->ID) ?>

                </div>

                <div class="card-body">
                    <?php echo Liga::objects2table(new FieldSettings($dbContext, "Liga"), Liga::getObjects($dbContext, "WHERE ".get_class($object)."ID = ".$object->ID, "")); ?>
                </div>

                <div class="card-footer">
                    <form action="./ligen_create.php" method="post">
                        <input type="hidden" name="SportverbandID"
                            value="<?php echo $ID; ?>" />
                        <button type="submit" class="btn btn-success">
                            <img class="listIcon" src="./icon/Create.png" title="Anlegen"> | Anlegen
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <?php include('./include/html.body.footer.inc.php');?>
    </div>
</body>

</html>