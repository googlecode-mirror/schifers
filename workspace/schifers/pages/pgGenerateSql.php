<?php

	/*
	* pgGenerateSql.php
	*
	* Generate Sql.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: September 26, 2007
	*/
	
	$module_name = "generate_sql";

	require '../../schifers/constants/cdConstants.php';
	require '../../'.$WEB_SITE.'src/cdDatabase.php';
	require '../../'.$WEB_SITE.'src/cdDate.php';

	require '../../'.$WEB_SITE.'src/cdUser.php';
	require '../../'.$WEB_SITE.'src/cdSession.php';
	require '../../'.$WEB_SITE.'src/cdArea.php';
	require '../../'.$WEB_SITE.'src/cdSubject.php';
	require '../../'.$WEB_SITE.'src/cdArticle.php';
	require '../../'.$WEB_SITE.'src/cdMenu.php';
	require '../../'.$WEB_SITE.'src/cdModule.php';
	require '../../'.$WEB_SITE.'src/cdNew.php';
	require '../../'.$WEB_SITE.'src/cdProfile.php';
	require '../../'.$WEB_SITE.'src/cdPage.php';
	require '../../'.$WEB_SITE.'src/cdParagraph.php';
	require '../../'.$WEB_SITE.'src/cdPrivilege.php';
	require '../../'.$WEB_SITE.'src/cdRole.php';
	require '../../'.$WEB_SITE.'src/cdMenuItem.php';
	require '../../'.$WEB_SITE.'src/cdShout.php';
	require '../../'.$WEB_SITE.'src/cdUserInfo.php';
	require '../../'.$WEB_SITE.'src/cdTopic.php';
	require '../../'.$WEB_SITE.'src/cdMessage.php';
	require '../../'.$WEB_SITE.'src/cdModerator.php';

	require '../../'.$WEB_SITE.'src/cdGuardian.php';

	$message_position = "";

	if(isset($_POST["p_action"]))
	{
		$action = $_POST["p_action"];

		if($action == 1)
		{
		
			$handle1 = fopen("../../schifers/actions/doArticles.php", "w+");
			$handle2 = fopen("../../schifers/actions/doArticles.bkp", "w+");
		
			$user = new User();
			
			$user->SetDatabase($database);
			
			$user->Backup($handle1, $handle2);
		
			$session = new Session();
			
			$session->SetDatabase($database);
			
			$session->Backup($handle1, $handle2);
		
			$area = new Area();
			
			$area->SetDatabase($database);
			
			$area->Backup($handle1, $handle2);

			$subject = new Subject();
			
			$subject->SetDatabase($database);
			
			$subject->Backup($handle1, $handle2);
		
			$article = new Article();
			
			$article->SetDatabase($database);
			
			$article->Backup($handle1, $handle2);
		
			$page = new Page();
			
			$page->SetDatabase($database);
			
			$page->Backup($handle1, $handle2);
		
			$menu = new Menu();
			
			$menu->SetDatabase($database);
			
			$menu->Backup($handle1, $handle2);
		
			$module = new Module();
			
			$module->SetDatabase($database);
			
			$module->Backup($handle1, $handle2);
		
			$new = new News();
			
			$new->SetDatabase($database);
			
			$new->Backup($handle1, $handle2);
		
			$profile = new Profile();
			
			$profile->SetDatabase($database);
			
			$profile->Backup($handle1, $handle2);
		
			$paragraph = new Paragraph();
			
			$paragraph->SetDatabase($database);
			
			$paragraph->Backup($handle1, $handle2);
		
			$privilege = new Privilege();
			
			$privilege->SetDatabase($database);
			
			$privilege->Backup($handle1, $handle2);
		
			$role = new Role();
			
			$role->SetDatabase($database);
			
			$role->Backup($handle1, $handle2);
		
			$menu_item = new MenuItem();
			
			$menu_item->SetDatabase($database);
			
			$menu_item->Backup($handle1, $handle2);
		
			$shout = new Shout();
			
			$shout->SetDatabase($database);
			
			$shout->Backup($handle1, $handle2);
		
			$user_info = new UserInfo();
			
			$user_info->SetDatabase($database);
			
			$user_info->Backup($handle1, $handle2);
		
			$topic = new Topic();
			
			$topic->SetDatabase($database);
			
			$topic->Backup($handle1, $handle2);

			$c_message = new Message();
			
			$c_message->SetDatabase($database);
			
			$c_message->Backup($handle1, $handle2);
		
			$moderator = new Moderator();
			
			$moderator->SetDatabase($database);
			
			$moderator->Backup($handle1, $handle2);

			fclose($handle1);
			fclose($handle2);
		
			$message_position = 1;
			$message = "Arquivo criado com sucesso!";
		}
		
	}

?>

<html>
	<head>
		<title>Schifer's</title>
		<link rel="stylesheet" type="text/css" href="/schifers/css/schifers.css">
		<script language="Javascript">
			
			function Generate()
			{
				document.form_admin.p_action.value="1";
				document.form_admin.submit();
			}
			
		</script>
	</head>
	<body bgcolor="#FFFFFF">

<?php

	require '../../'.$WEB_SITE.'blocks/blTitle.php';

?>

	<table width="100%" cellspacing="1" bgcolor="#000000">
		<form name="form_admin" method="post">
			<input type="hidden" name="p_action">
			<tr>
				<td bgcolor="#EEEEEE" width="100%" valign="top" class="form_title" colspan="2">
				Gerador de SQL - Backup do Site
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="100%" valign="center" align="center" colspan="2">
					<a href="javascript:Generate();">Gerar</a>&nbsp;
					<a href="/schifers/pages/pgRestricted.php">Voltar</a>&nbsp;

<?php

	if($action == 1)
	{
		
?>

					<a href="/schifers/actions/doArticles.bkp">Backup</a>&nbsp;

<?php		
		
	}

?>
					
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="100%" valign="center" align="center" colspan="2">
					<font color="#FF0000">
<?php

	if($message != "" && $message_position == 1)
	{
		echo $message;
	}
	else
	{
		echo "&nbsp;";
	}

?>				
					</font>
				</td>
			</tr>
		</form>
	</table>

<?php

	require '../../'.$WEB_SITE.'blocks/blBottom.php';

?>
	
	</body>
</html>
