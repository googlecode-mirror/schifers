<?php

	/*
	* blDatabase.php
	*
	* Database creation block.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: August 04, 2007
	*/

	/* Dependencies
	*
	* require '../constants/cdConstants.php';
	* require '../../'.$WEB_SITE.'src/cdDatabase.php';
	* require '../../'.$WEB_SITE.'src/cdUser.php';
	* require '../../'.$WEB_SITE.'src/cdSession.php';
	* require '../../'.$WEB_SITE.'src/cdMessage.php';
	* require '../../'.$WEB_SITE.'src/cdTopic.php';
	* require '../../'.$WEB_SITE.'src/cdArticle.php';
	* require '../../'.$WEB_SITE.'src/cdMenu.php';
	* require '../../'.$WEB_SITE.'src/cdModule.php';
	* require '../../'.$WEB_SITE.'src/cdNew.php';
	* require '../../'.$WEB_SITE.'src/cdProfile.php';
	* require '../../'.$WEB_SITE.'src/cdPage.php';
	* require '../../'.$WEB_SITE.'src/cdParagraph.php';
	* require '../../'.$WEB_SITE.'src/cdPrivilege.php';
	* require '../../'.$WEB_SITE.'src/cdRole.php';
	* require '../../'.$WEB_SITE.'src/cdMenuItem.php';
	* require '../../'.$WEB_SITE.'src/cdShout.php';
	* require '../../'.$WEB_SITE.'src/cdUserInfo.php';
	* require '../../'.$WEB_SITE.'src/cdSubject.php';
	* require '../../'.$WEB_SITE.'src/cdModerator.php';
	*
	*/
	
	require '../../schifers/constants/cdConstants.php';
	require '../../'.$WEB_SITE.'src/cdDatabase.php';
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

	if(isset($_GET["message"]))
	{
		$message = $_GET["message"];
	}
	
	if(isset($_GET["step"]))
	{
		$step = $_GET["step"];

		echo $step;
		
		if($step == 0)
		{
			for($i = 0; $i < 50; $i++)
			{

?>

	<script language="Javascript">
		window.parent.document.all.td_progress<?php echo $i; ?>.style.backgroundColor = "#FFFFFF";
	</script>

<?php

			}

?>

	<script language="Javascript">
		window.location = "<?php echo '../../'.$WEB_SITE; ?>blocks/blDatabase.php?step=1";
	</script>

<?php

		}

		for($i = 0; $i < 50; $i++)
		{
			if($step == $i)
			{
				for($k = 0; $k < $i; $k++)
				{

?>

	<script language="Javascript">
		window.parent.document.all.td_progress<?php echo $k; ?>.style.backgroundColor = "#000000";
	</script>
	
<?php
	
				}

				$message = $i * 2;
				$message = $message."%";

				switch($i)
				{
					case 1:
						$database->DropTables();
					
						break;
					case 2:
						$user = new User();
						
						$user->SetDatabase($database);
						
						$user->Create();
					
						break;
					case 3:
						$session = new Session();
						
						$session->SetDatabase($database);
						
						$session->Create();
					
						break;
					case 4:
						$area = new Area();
						
						$area->SetDatabase($database);
						
						$area->Create();
					
						break;
					case 5:
						$subject = new Subject();
						
						$subject->SetDatabase($database);
						
						$subject->Create();
					
						break;
					case 6:
						$article = new Article();
						
						$article->SetDatabase($database);
						
						$article->Create();
					
						break;
					case 7:
						$page = new Page();
						
						$page->SetDatabase($database);
						
						$page->Create();
					
						break;
					case 8:
						$menu = new Menu();
						
						$menu->SetDatabase($database);
						
						$menu->Create();
					
						break;
					case 9:
						$module = new Module();
						
						$module->SetDatabase($database);
						
						$module->Create();
					
						break;
					case 10:
						$new = new News();
						
						$new->SetDatabase($database);
						
						$new->Create();
					
						break;
					case 11:
						$profile = new Profile();
						
						$profile->SetDatabase($database);
						
						$profile->Create();
					
						break;
					case 12:
						$paragraph = new Paragraph();
						
						$paragraph->SetDatabase($database);
						
						$paragraph->Create();
					
						break;
					case 13:
						$privilege = new Privilege();
						
						$privilege->SetDatabase($database);
						
						$privilege->Create();
					
						break;
					case 14:
						$role = new Role();
						
						$role->SetDatabase($database);
						
						$role->Create();
					
						break;
					case 15:
						$menu_item = new MenuItem();
						
						$menu_item->SetDatabase($database);
						
						$menu_item->Create();
					
						break;
					case 16:
						$shout = new Shout();
						
						$shout->SetDatabase($database);
						
						$shout->Create();
					
						break;
					case 17:
						$user_info = new UserInfo();
						
						$user_info->SetDatabase($database);
						
						$user_info->Create();
					
						break;
					case 18:
						$topic = new Topic();
						
						$topic->SetDatabase($database);
						
						$topic->Create();

						break;
					case 19:
						$c_message = new Message();
						
						$c_message->SetDatabase($database);
						
						$c_message->Create();
					
						break;
					case 20:
						$moderator = new Moderator();
						
						$moderator->SetDatabase($database);
						
						$moderator->Create();

						break;
/*
					case 21:
						$user = new User();
						
						$user->SetDatabase($database);
						$user->SetUsername("admin");
						$user->SetPassword("schifer211276");
						$user->SetActive(1);
						$user->Encrypt();
						
						$user->Insert();
					
						$user->SetUsername("guest");
						$user->SetPassword("guest");
						$user->SetActive(1);
						$user->Encrypt();
						
						$user->Insert();

						break;
					case 22:
						$module = new Module();
						
						$module->SetDatabase($database);

						$module->SetNick("main"); $module->SetName("Principal"); $module->SetUrl("index.php"); $module->Insert();
						$module->SetNick("admin"); $module->SetName("Administração"); $module->SetUrl("/pages/pgAdmin.php"); $module->Insert();
						$module->SetNick("inside"); $module->SetName("Interna"); $module->SetUrl("/pages/pgRestricted.php"); $module->Insert();
						$module->SetNick("module"); $module->SetName("Módulo"); $module->SetUrl("/pages/pgModule.php"); $module->Insert();
						$module->SetNick("user"); $module->SetName("Usuário"); $module->SetUrl("/pages/pgUser.php"); $module->Insert();
						$module->SetNick("session"); $module->SetName("Sessão"); $module->SetUrl("/pages/pgSession.php"); $module->Insert();
						$module->SetNick("profile"); $module->SetName("Perfil"); $module->SetUrl("/pages/pgProfile.php"); $module->Insert();
						$module->SetNick("article"); $module->SetName("Artigo"); $module->SetUrl("/pages/pgArticle.php"); $module->Insert();
						$module->SetNick("paragraph"); $module->SetName("Parágrafo"); $module->SetUrl("/pages/pgParagraph.php"); $module->Insert();
						$module->SetNick("new"); $module->SetName("Notícia"); $module->SetUrl("/pages/pgNew.php"); $module->Insert();
						$module->SetNick("menu"); $module->SetName("Menu"); $module->SetUrl("/pages/pgMenu.php"); $module->Insert();
						$module->SetNick("privilege"); $module->SetName("Privilégio"); $module->SetUrl("/pages/pgPrivilege.php"); $module->Insert();
						$module->SetNick("role"); $module->SetName("Papel"); $module->SetUrl("/pages/pgRole.php"); $module->Insert();
						$module->SetNick("forum"); $module->SetName("Fórum"); $module->SetUrl("/pages/pgForum.php"); $module->Insert();
						$module->SetNick("shout_page"); $module->SetName("Grito da Galera"); $module->SetUrl("/pages/pgShoutPage.php"); $module->Insert();
						$module->SetNick("article_page"); $module->SetName("Artigos"); $module->SetUrl("/pages/pgArticlePage.php"); $module->Insert();
						$module->SetNick("menu_item"); $module->SetName("Item de Menu"); $module->SetUrl("/pages/pgMenuItem.php"); $module->Insert();
						$module->SetNick("shout"); $module->SetName("Grito da Galera"); $module->SetUrl("/pages/pgShout.php"); $module->Insert();
						$module->SetNick("register"); $module->SetName("Cadastrar-se"); $module->SetUrl("/pages/pgRegister.php"); $module->Insert();
						$module->SetNick("activate_users"); $module->SetName("Ativar Usuários"); $module->SetUrl("/pages/pgActivateUsers.php"); $module->Insert();
						$module->SetNick("error"); $module->SetName("Erro"); $module->SetUrl("/pages/pgError.php"); $module->Insert();
						$module->SetNick("exit"); $module->SetName("Saída"); $module->SetUrl("/pages/pgExit.php"); $module->Insert();
						$module->SetNick("subject"); $module->SetName("Assunto"); $module->SetUrl("/pages/pgSubject.php"); $module->Insert();
						$module->SetNick("generate_sql"); $module->SetName("Gerador de SQL"); $module->SetUrl("/pages/pgGenerateSql.php"); $module->Insert();
						$module->SetNick("execute_sql"); $module->SetName("Executor de SQL"); $module->SetUrl("/pages/pgExecuteSql.php"); $module->Insert();
						$module->SetNick("page"); $module->SetName("Página"); $module->SetUrl("/pages/pgPage.php"); $module->Insert();
						$module->SetNick("topic"); $module->SetName("Tópico"); $module->SetUrl("/pages/pgTopic.php"); $module->Insert();
						$module->SetNick("message"); $module->SetName("Mensagem"); $module->SetUrl("/pages/pgMessage.php"); $module->Insert();
						$module->SetNick("moderator"); $module->SetName("Moderador"); $module->SetUrl("/pages/pgModerator.php"); $module->Insert();
					
						break;
					case 23:
						$menu = new Menu();
						
						$menu->SetDatabase($database);

						$menu->SetName("Principal"); $menu->Insert();
						$menu->SetName("Administração"); $menu->Insert();
					
						break;
					case 24:
						$menu_item = new MenuItem();
						
						$menu_item->SetDatabase($database);

						$menu_item->SetModule(14); $menu_item->SetMenu(1); $menu_item->SetOrder(1); $menu_item->Insert();
						$menu_item->SetModule(16); $menu_item->SetMenu(1); $menu_item->SetOrder(2); $menu_item->Insert();
						$menu_item->SetModule(15); $menu_item->SetMenu(1); $menu_item->SetOrder(3); $menu_item->Insert();
						$menu_item->SetModule(19); $menu_item->SetMenu(1); $menu_item->SetOrder(4); $menu_item->Insert();
						$menu_item->SetModule(8); $menu_item->SetMenu(2); $menu_item->SetOrder(1); $menu_item->Insert();
						$menu_item->SetModule(18); $menu_item->SetMenu(2); $menu_item->SetOrder(2); $menu_item->Insert();
						$menu_item->SetModule(17); $menu_item->SetMenu(2); $menu_item->SetOrder(3); $menu_item->Insert();
						$menu_item->SetModule(11); $menu_item->SetMenu(2); $menu_item->SetOrder(4); $menu_item->Insert();
						$menu_item->SetModule(4); $menu_item->SetMenu(2); $menu_item->SetOrder(5); $menu_item->Insert();
						$menu_item->SetModule(10); $menu_item->SetMenu(2); $menu_item->SetOrder(6); $menu_item->Insert();
						$menu_item->SetModule(13); $menu_item->SetMenu(2); $menu_item->SetOrder(7); $menu_item->Insert();
						$menu_item->SetModule(9); $menu_item->SetMenu(2); $menu_item->SetOrder(8); $menu_item->Insert();
						$menu_item->SetModule(7); $menu_item->SetMenu(2); $menu_item->SetOrder(9); $menu_item->Insert();
						$menu_item->SetModule(12); $menu_item->SetMenu(2); $menu_item->SetOrder(10); $menu_item->Insert();
						$menu_item->SetModule(6); $menu_item->SetMenu(2); $menu_item->SetOrder(11); $menu_item->Insert();
						$menu_item->SetModule(5); $menu_item->SetMenu(2); $menu_item->SetOrder(12); $menu_item->Insert();
						$menu_item->SetModule(20); $menu_item->SetMenu(2); $menu_item->SetOrder(13); $menu_item->Insert();
						$menu_item->SetModule(23); $menu_item->SetMenu(2); $menu_item->SetOrder(14); $menu_item->Insert();
						$menu_item->SetModule(24); $menu_item->SetMenu(2); $menu_item->SetOrder(15); $menu_item->Insert();
						$menu_item->SetModule(25); $menu_item->SetMenu(2); $menu_item->SetOrder(16); $menu_item->Insert();
						$menu_item->SetModule(26); $menu_item->SetMenu(2); $menu_item->SetOrder(17); $menu_item->Insert();
						$menu_item->SetModule(27); $menu_item->SetMenu(2); $menu_item->SetOrder(18); $menu_item->Insert();
						$menu_item->SetModule(28); $menu_item->SetMenu(2); $menu_item->SetOrder(19); $menu_item->Insert();
						$menu_item->SetModule(29); $menu_item->SetMenu(2); $menu_item->SetOrder(20); $menu_item->Insert();

						break;
					case 25:
						$profile = new Profile();
						
						$profile->SetDatabase($database);

						$profile->SetName("Administrador"); $profile->Insert();
						$profile->SetName("Convidado"); $profile->Insert();

						break;
					case 26:
						$role = new Role();
						
						$role->SetDatabase($database);

						$role->SetUser(1); $role->SetProfile(1); $role->Insert();
						$role->SetUser(2); $role->SetProfile(2); $role->Insert();

						break;
					case 27:
						$privilege = new Privilege();
						
						$privilege->SetDatabase($database);

						$privilege->SetModule(1); $privilege->SetProfile(2); $privilege->Insert();
						$privilege->SetModule(19); $privilege->SetProfile(2); $privilege->Insert();
						$privilege->SetModule(21); $privilege->SetProfile(2); $privilege->Insert();
						$privilege->SetModule(22); $privilege->SetProfile(2); $privilege->Insert();
						$privilege->SetModule(14); $privilege->SetProfile(2); $privilege->Insert();
						$privilege->SetModule(15); $privilege->SetProfile(2); $privilege->Insert();
						$privilege->SetModule(16); $privilege->SetProfile(2); $privilege->Insert();
						$privilege->SetModule(1); $privilege->SetProfile(1); $privilege->Insert();
						$privilege->SetModule(3); $privilege->SetProfile(1); $privilege->Insert();
						$privilege->SetModule(21); $privilege->SetProfile(1); $privilege->Insert();
						$privilege->SetModule(8); $privilege->SetProfile(1); $privilege->Insert();
						$privilege->SetModule(18); $privilege->SetProfile(1); $privilege->Insert();
						$privilege->SetModule(17); $privilege->SetProfile(1); $privilege->Insert();
						$privilege->SetModule(11); $privilege->SetProfile(1); $privilege->Insert();
						$privilege->SetModule(4); $privilege->SetProfile(1); $privilege->Insert();
						$privilege->SetModule(10); $privilege->SetProfile(1); $privilege->Insert();
						$privilege->SetModule(13); $privilege->SetProfile(1); $privilege->Insert();
						$privilege->SetModule(9); $privilege->SetProfile(1); $privilege->Insert();
						$privilege->SetModule(7); $privilege->SetProfile(1); $privilege->Insert();
						$privilege->SetModule(12); $privilege->SetProfile(1); $privilege->Insert();
						$privilege->SetModule(6); $privilege->SetProfile(1); $privilege->Insert();
						$privilege->SetModule(5); $privilege->SetProfile(1); $privilege->Insert();
						$privilege->SetModule(20); $privilege->SetProfile(1); $privilege->Insert();
						$privilege->SetModule(22); $privilege->SetProfile(1); $privilege->Insert();
						$privilege->SetModule(23); $privilege->SetProfile(1); $privilege->Insert();
						$privilege->SetModule(16); $privilege->SetProfile(1); $privilege->Insert();
						$privilege->SetModule(24); $privilege->SetProfile(1); $privilege->Insert();
						$privilege->SetModule(25); $privilege->SetProfile(1); $privilege->Insert();
						$privilege->SetModule(26); $privilege->SetProfile(1); $privilege->Insert();
						$privilege->SetModule(27); $privilege->SetProfile(1); $privilege->Insert();
						$privilege->SetModule(28); $privilege->SetProfile(1); $privilege->Insert();
						$privilege->SetModule(14); $privilege->SetProfile(1); $privilege->Insert();
						$privilege->SetModule(15); $privilege->SetProfile(1); $privilege->Insert();
						$privilege->SetModule(19); $privilege->SetProfile(1); $privilege->Insert();
						$privilege->SetModule(29); $privilege->SetProfile(1); $privilege->Insert();

						break;
					case 28:
						$users_info = new UserInfo();
						
						$users_info->SetDatabase($database);

						$users_info->SetUser(1); $users_info->SetFirstName("Administrador"); $users_info->SetLastName("SCHIFER"); $users_info->SetNick("Administrador"); $users_info->SetEmail("schifers@hotmail.com"); $users_info->Insert();
						$users_info->SetUser(2); $users_info->SetFirstName("Convidado"); $users_info->SetFirstName("SCHIFER"); $users_info->SetNick("Convidado"); $users_info->SetEmail("schifers@hotmail.com"); $users_info->Insert();

						break;
*/
					case 49:
						$message = "100%";
						break;
					default:
						$i = 48;
						break;
				}

				if($message != "")
				{

?>

	<script language="Javascript">
		window.parent.document.all.td_message.innerHTML = "<?php echo $message; ?>";
	</script>

<?php

				}
	
?>

	<script language="Javascript">
		window.location = "<?php echo '../../'.$WEB_SITE; ?>blocks/blDatabase.php?step=<?php $j = $i + 1; echo $j; if($message != "") { echo "&message=".$message; } ?>";
	</script>

<?php

			}
		
		}
		
	}

	if($step == 50)
	{
	
?>

	<script language="Javascript">
		window.parent.document.all.td_progress49.style.backgroundColor = "#000000";
	</script>

<?php

	}

?>