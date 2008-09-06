<?php

	/*
	* pgProjectDetail.php
	*
	* This is the project detail page.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: May 26, 2008
	*/

	$module_name = "project_detail";
	
	if(isset($_GET["nick"]))
	{
		$module_name = $_GET["nick"];
	}

	require '../../schifers/constants/cdConstants.php';
	require '../../'.$WEB_SITE.'src/cdDatabase.php';
	require '../../'.$WEB_SITE.'src/cdDate.php';
	require '../../'.$WEB_SITE.'src/cdUser.php';
	require '../../'.$WEB_SITE.'src/cdSession.php';
	require '../../'.$WEB_SITE.'src/cdGuardian.php';
	require '../../'.$WEB_SITE.'src/cdArea.php';
	require '../../'.$WEB_SITE.'src/cdSubject.php';
	require '../../'.$WEB_SITE.'src/cdArticle.php';
	require '../../'.$WEB_SITE.'src/cdPage.php';
	require '../../'.$WEB_SITE.'src/cdParagraph.php';
	
?>

<html>
	<head>
		<title>Schifer's</title>
		<link rel="stylesheet" type="text/css" href="/schifers/css/schifers.css">
	</head>
	<body bgcolor="#FFFFFF">
		<form name="form_admin" method="post">
			<input type="hidden" name="p_arti_id" value="<?php echo $arti_id; ?>">
			<input type="hidden" name="p_page_id" value="<?php echo $page_id; ?>">

<?php

	require '../../'.$WEB_SITE.'blocks/blTitle.php';

?>

	<table width="100%" cellspacing="0" bgcolor="#EEEEEE">
		<tr>
			<td bgcolor="#EEEEEE" width="20%" valign="top" align="center">
			
<?php
	
	require '../../'.$WEB_SITE.'blocks/blProjectDetailLeftFrame.php';

?>

			</td>
			<td bgcolor="#EEEEEE" width="60%" valign="top" align="center">
			
<?php

	require '../../'.$WEB_SITE.'blocks/blProjectDetailMainFrame.php';

?>

			</td>
			<td bgcolor="#EEEEEE" width="20%" valign="top" align="center">
			
<?php

	require '../../'.$WEB_SITE.'blocks/blProjectDetailRightFrame.php';

?>

			</td>
		</tr>
	</table>

<?php

	require '../../'.$WEB_SITE.'blocks/blBottom.php';

?>

		</form>
	</body>
</html>
