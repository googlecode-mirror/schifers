<?php

	/*
	* pgCreateDatabase.php
	*
	* Database creation.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: August 02, 2007
	*/

	require 'schifers/constants/cdConstants.php';
	require $WEB_SITE.'src/cdDatabase.php';
	require $WEB_SITE.'src/cdDate.php';

?>

<html>
	<head>
		<title>Schifer's</title>
		<link rel="stylesheet" type="text/css" href="/schifers/css/schifers.css">
		<script language="Javascript">
		
			function Iniciar()
			{
				window.document.all.ifr_progress.src = "<?php echo $WEB_SITE; ?>blocks/blDatabase.php?step=0";
			}
		
		</script>
	</head>

	<body bgcolor="#FFFFFF">

		<iframe name="ifr_progress" style="visibility:hidden;position:absolute;" src="blocks/blDatabase.php" width="0" height="0" align="center" frameborder="0" hspace="0" vspace="0" scrolling="no" marginwidth="0" marginheight="0"></iframe>

<?php

	require $WEB_SITE.'blocks/blTitle.php';

?>

<?php

	require $WEB_SITE.'blocks/blSpace.php';

?>

	<table width="100%" cellspacing="1" bgcolor="#000000">
		<form name="frm_install" action="" method="post">
			<tr>
				<td bgcolor="#CCCCCC" width="100%" valign="top" align="center">
					Instalação da Página
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="100%" valign="top" align="center">
					<input type="button" value="Instalar"class="btn" onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" onclick="Iniciar();">
				</td>
			</tr>
		</form>
	</table>

<?php

	require $WEB_SITE.'blocks/blSpace.php';

?>

<?php

	require $WEB_SITE.'blocks/blInstallation.php';
	
?>

<?php

	require $WEB_SITE.'blocks/blSpace.php';

?>

<?php
	require $WEB_SITE.'blocks/blBottom.php';
?>
	
	</body>
</html>
