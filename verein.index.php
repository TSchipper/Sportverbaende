<?php
include('./support/FormBuilder.php');
include('./include/html.head.inc.php');
?>

<body>
	<div class="grid-container">
		<?php
            include('./include/html.body.header.inc.php');
include('./include/html.body.navigation.inc.php');
echo FormBuilder::buildForm(
    null //$action
    ,
    null //$method
    ,
    "./icon/hide.png" //$headerIcon
    ,
    "Verein [Mockup]" //$headertitle
    ,
    "Verein [Mockup]" //$body
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