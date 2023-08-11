<?php
$title = "Sportverbände";
$navElement = "navToSportverbaende";
include('./include/html.head.inc.php');
?>

<body>
	<div class="grid-container">
		<?php
            include('./include/html.body.header.inc.php');
include('./include/html.body.navigation.inc.php'); ?>
		<div class="content">
			<?php include('./sportverband.overview.php'); ?>
		</div>
		<?php include('./include/html.body.footer.inc.php'); ?>
	</div>
</body>

</html>