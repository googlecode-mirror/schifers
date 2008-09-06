<?php

	/*
	* pgMain.php
	*
	* This is the main page of the web.
	* The reason of this web site is to build a community with people with the same interests.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: July 30, 2007
	*/

	$module_name = "main";

	require 'schifers/constants/cdConstants.php';
	require $WEB_SITE.'src/cdDatabase.php';
	require $WEB_SITE.'src/cdDate.php';
	require $WEB_SITE.'src/cdUser.php';
	require $WEB_SITE.'src/cdSession.php';
	require $WEB_SITE.'src/cdGuardian.php';
	require $WEB_SITE.'src/cdMenu.php';
	require $WEB_SITE.'src/cdMenuBuilder.php';
	require $WEB_SITE.'src/cdNew.php';
	require $WEB_SITE.'src/cdShout.php';
	
?>

<html>
	<head>
		<title>Schifer's</title>
		<link rel="stylesheet" type="text/css" href="/schifers/css/schifers.css">
		
		<script language="Javascript">
            function DesligaEnter() {
                if(window.event.keyCode == 13) {
                    return false;
                }
                return true;
            }
		</script>
	</head>
	<body bgcolor="#FFFFFF" onload="document.form_login.p_username.focus();" onkeydown="return DesligaEnter();">

<?php

	require $WEB_SITE.'blocks/blTitle.php';

?>

	<table width="100%" cellspacing="0" bgcolor="#EEEEEE">
		<tr>
			<td bgcolor="#EEEEEE" width="20%" valign="top" align="center">
			
<?php
	
	require $WEB_SITE.'blocks/blLeftFrame.php';

?>

			</td>
			<td bgcolor="#EEEEEE" width="60%" valign="top" align="center">
			
<?php

	require $WEB_SITE.'blocks/blMainFrame.php';

?>

			</td>
			<td bgcolor="#EEEEEE" width="20%" valign="top" align="center">
			
<?php

	require $WEB_SITE.'blocks/blRightFrame.php';

?>

			</td>
		</tr>
	</table>

<?php

	require $WEB_SITE.'blocks/blBottom.php';

?>
	
	</body>
</html>
