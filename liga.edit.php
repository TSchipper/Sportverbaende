<?php
$title = "Ligen";
$navElement = "navToLiga";
include('./include/html.head.inc.php');
?>

<body>
    <div class="grid-container">
        <?php
        include('./include/html.body.header.inc.php');
include('./include/html.body.navigation.inc.php');
?>
        <div class="content">
            <form action="./liga.controller.php" method="post">
                <div class="card">
                    <div class="card-header">
                        <img class="listIcon" src="./icon/Edit.png" title="Bearbeiten">
                        Liga&nbsp;<span class="objectName">
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
        </div>
        <?php include('./include/html.body.footer.inc.php');?>
    </div>
</body>

</html>