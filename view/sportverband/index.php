<!DOCTYPE html>
<html lang="de">

<?php
    include('../../include/html.head.inc.php');
showDynamicHtmlHead("Sportverbände", "navToLSportverbaende");
?>

<body>
	<div class="grid-container">
		<?php
        include('../../include/html.body.header.inc.php');
showDynamicHeader("Sportverbände");
include('../../include/html.body.navigation.inc.php');
?>

		<div class="content">
			<?php include('./overview.php');?>
		</div>
		<?php include('../include/html.body.footer.inc.php');?>
	</div>
</body>

</html>