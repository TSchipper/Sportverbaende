<?php
$title = "Sportverbände";
$navElement = "navToSportverband";
$className = "Sportverband";
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
                        <img class="listIcon" src="./icon/Create.png">
                        Sportverband anlegen
                    </div>
                    <div class="card-body">
                        <?php echo basic::object2createCardBody($dbContext, $fieldSettings, $className);?>
                    </div>
                    <div class="card-footer">
                        <?php include("./include/html.body.object.create.footer.inc.php");?>
                    </div>
                </div>
            </form>
        </div>
        <?php include('./include/html.body.footer.inc.php');?>
    </div>
</body>

</html>