<?php

	/*
	* pgNewQuery.php
	*
	* NewQuery.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: August 04, 2007
	*/
	
	$module_name = "new";

	require '../../schifers/constants/cdConstants.php';
	require '../../'.$WEB_SITE.'src/cdDatabase.php';
	require '../../'.$WEB_SITE.'src/cdDate.php';
	require '../../'.$WEB_SITE.'src/cdNew.php';
	require '../../'.$WEB_SITE.'src/cdUser.php';
	require '../../'.$WEB_SITE.'src/cdSession.php';
	require '../../'.$WEB_SITE.'src/cdGuardian.php';
	
?>

<html>
	<head>
		<title>Schifer's</title>
		<link rel="stylesheet" type="text/css" href="/schifers/css/schifers.css">
		<script language="Javascript">
			
			function Select()
			{
				window.opener.form_admin.p_news_id.value = document.form_query.p_news_id.options[document.form_query.p_news_id.options.selectedIndex].value;
				window.opener.form_admin.p_action.value="1";
				window.opener.form_admin.submit();
				Close();
			}
			
			function Close()
			{
				window.close();
			}
			
		</script>
	</head>
	
	<body bgcolor="#FFFFFF">

	<table width="100%" cellspacing="1" bgcolor="#000000">
		<form name="form_query" method="post">
			<tr>
				<td bgcolor="#EEEEEE" width="100%" valign="top" class="form_title" colspan="2">
				Notícias
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Título:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<select name="p_news_id">
						<option value="">Selecione</option>

<?php

	$article = new News();
	$article->SetDatabase($database);
	$result = $article->Select();
	
	while ($data = $database->FetchArray($result))
	{
		$news_id = $data["news_id"];
		$news_title = $data["news_title"];
		
		echo "<option value=\"".$news_id."\">".$news_title."</option>";
	}
	
?>

					</select>
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="100%" valign="center" align="center" colspan="2">
					<a href="javascript:Select();">Selecionar</a>&nbsp;
					<a href="javascript:Close();">Fechar</a>
				</td>
			</tr>
		</form>
	</table>

	</body>
</html>
