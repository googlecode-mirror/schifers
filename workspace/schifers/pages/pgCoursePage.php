<?php

	/*
	* pgCoursePage.php
	*
	* This is the course page.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: May 26, 2008
	*/

	$module_name = "course_page";

	require '../../schifers/constants/cdConstants.php';
	require '../../'.$WEB_SITE.'src/cdDatabase.php';
	require '../../'.$WEB_SITE.'src/cdDate.php';
	require '../../'.$WEB_SITE.'src/cdUser.php';
	require '../../'.$WEB_SITE.'src/cdSession.php';
	require '../../'.$WEB_SITE.'src/cdGuardian.php';
	require '../../'.$WEB_SITE.'src/cdMenu.php';
	require '../../'.$WEB_SITE.'src/cdMenuBuilder.php';
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

<?php

	require '../../'.$WEB_SITE.'blocks/blTitle.php';

?>

	<table width="100%" cellspacing="0" bgcolor="#EEEEEE">
		<tr>
			<td bgcolor="#EEEEEE" width="20%" valign="top" align="center">
			
<?php
	
	require '../../'.$WEB_SITE.'blocks/blCourseLeftFrame.php';

?>

			</td>
			<td bgcolor="#EEEEEE" width="60%" valign="top" align="center">
			
<?php

	require '../../'.$WEB_SITE.'blocks/blCourseMainFrame.php';

?>

			</td>
			<td bgcolor="#EEEEEE" width="20%" valign="top" align="center">
			
<?php

	require '../../'.$WEB_SITE.'blocks/blCourseRightFrame.php';

?>

			</td>
		</tr>
	</table>

<?php

	require '../../'.$WEB_SITE.'blocks/blBottom.php';

?>
	
	</body>
</html>
