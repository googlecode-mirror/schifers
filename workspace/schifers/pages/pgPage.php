<?php

	/*
	* pgPage.php
	*
	* Page.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: September 28, 2007
	*/
	
	$module_name = "page";

	require '../../schifers/constants/cdConstants.php';
	require '../../'.$WEB_SITE.'src/cdDatabase.php';
	require '../../'.$WEB_SITE.'src/cdDate.php';
	require '../../'.$WEB_SITE.'src/cdUser.php';
	require '../../'.$WEB_SITE.'src/cdSubject.php';
	require '../../'.$WEB_SITE.'src/cdArticle.php';
	require '../../'.$WEB_SITE.'src/cdPage.php';
	require '../../'.$WEB_SITE.'src/cdSession.php';
	require '../../'.$WEB_SITE.'src/cdGuardian.php';
	
	$screen_module_name = "Página";
	$message_position = 0;

	if(!isset($_POST["p_page_user_id"]))
	{
		$page_user_id = $guardian->GetUserId();
	}

	if(!isset($_POST["p_para_date"]))
	{
		$date = new Date();
		$page_date = $date->GetNowFull();
	}

	if(isset($_POST["p_action"]))
	{
		$action = $_POST["p_action"];
		$page_id = $_POST["p_page_id"];
		$page_number = $_POST["p_page_number"];
		$page_date = $_POST["p_page_date"];
		$page_user_id = $_POST["p_page_user_id"];
		$page_arti_id = $_POST["p_page_arti_id"];
		$message = "";
		
		if($page_user_id == "")
		{
			$page_user_id = $guardian->GetUserId();
		}

		if($page_date == "")
		{
			$date = new Date();
			$page_date = $date->GetNowFull();
		}

		if($action == 1)
		{
			$page = new Page();
			$page->SetDatabase($database);
			$page->SetId($page_id);
			$page->SelectById();
			
			$date = new Date();
			$date->SetDate($page->GetDate());
			$date->ConvertToFullDisplay();

			$page_id = $page->GetId();
			$page_number = $page->GetNumber();
			$page_date = $date->GetConverted();
			$page_user_id = $page->GetUser();
			$page_arti_id = $page->GetArticle();

			if($page_id == "")
			{
				$message_position = 5;
				$message = $screen_module_name." não encontrada.";
				$page_id = "";
				$page_number = "";
				$page_date = $date->GetNowFull();
				$page_user_id = $guardian->GetUserId();
				$page_arti_id = "";
			}
		}
		
		if($action == 2)
		{
			$date = new Date();
			$date->SetConverted($page_date);
			$date->ConvertToFullDate();
			
			if($date->VerifyDate())
			{
				$message = $date->GetMessage();
				$message_position = 2;
			}
			else
			{
				$page = new Page();
				$page->SetDatabase($database);
				$page->SetNumber($page_number);
				$page->SetDate($date->GetDate());
				$page->SetUser($page_user_id);
				$page->SetArticle($page_arti_id);

				if($page->Insert())
				{			
					$message_position = 5;
					$message = $screen_module_name." incluída com sucesso.";
					$page_id = "";
					$page_number = "";
					$page_date = $date->GetNowFull();
					$page_user_id = $guardian->GetUserId();
					$page_arti_id = "";
				}
				else
				{
					$message_position = 5;
					$message = "Problemas na operação.";
				}
			}
		}

		if($action == 3)
		{
			$date = new Date();
			$date->SetConverted($page_date);
			$date->ConvertToFullDate();

			
			if($date->VerifyDate())
			{
				$message = $date->GetMessage();
				$message_position = 2;
			}
			else
			{
				$page = new Page();
				$page->SetDatabase($database);
				$page->SetId($page_id);
				$page->SetNumber($page_number);
				$page->SetDate($date->GetDate());
				$page->SetUser($page_user_id);
				$page->SetArticle($page_arti_id);
			
				if($page->Update())
				{			
					$message_position = 5;
					$message = $screen_module_name." alterada com sucesso.";
				}
				else
				{
					$message_position = 5;
					$message = "Problemas na operação.";
				}
			}
		}

		if($action == 4)
		{
			$page = new Page();
			$page->SetDatabase($database);
			$page->SetId($page_id);
			
			if($page->Delete())
			{			
				$date = new Date();

				$message_position = 5;
				$message = $screen_module_name." excluída com sucesso.";
				$page_id = "";
				$page_number = "";
				$page_date = $date->GetNowFull();
				$page_user_id = $guardian->GetUserId();
				$page_arti_id = "";
			}
			else
			{
				$message_position = 5;
				$message = "Problemas na operação.";
			}
		}

	}

?>

<html>
	<head>
		<title>Schifer's</title>
		<link rel="stylesheet" type="text/css" href="/schifers/css/schifers.css">
		<script language="Javascript">
			
			function QueryNumber()
			{
				document.all.ifr_general.src = "../actions/doQueryNumber.php?p_page_arti_id=" + document.form_admin.p_page_arti_id.options[document.form_admin.p_page_arti_id.options.selectedIndex].value;
			}
			
			function Clear()
			{
				document.form_admin.p_page_id.value = "";
				document.form_admin.p_page_number.value = "";
				document.form_admin.p_page_date.value = "";
				document.form_admin.p_page_user_id.selectedIndex = 0;
				document.form_admin.p_page_arti_id.selectedIndex = 0;
				document.form_admin.p_action.value="0";
				document.form_admin.submit();
			}
			
			function Query()
			{
				window.open("pgPageQuery.php", "queryPage", "width=600,height=500,top=150,left=150,toolbar=0,location=0,status=0,menubar=0,scrollbars=1,resizable=1");
			}
			
			function Insert()
			{
				document.form_admin.p_action.value="2";
				document.form_admin.submit();
			}
			
			function Update()
			{
				document.form_admin.p_action.value="3";
				document.form_admin.submit();
			}
			
			function Delete()
			{
				document.form_admin.p_action.value="4";
				document.form_admin.submit();
			}
			
		</script>
	</head>
	<body bgcolor="#FFFFFF">

<?php

	require '../../'.$WEB_SITE.'blocks/blTitle.php';

?>

	<iframe style="visibility:hidden;position:absolute;" id="ifr_general"></iframe>

	<table width="100%" cellspacing="1" bgcolor="#000000">
		<form name="form_admin" method="post">
			<input type="hidden" name="p_action">
			<input type="hidden" name="p_page_id" value="<?php echo $page_id; ?>">
			<tr>
				<td bgcolor="#EEEEEE" width="100%" valign="top" class="form_title" colspan="2">
				Páginas
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Data:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<input type="text" name="p_page_date" value="<?php echo $page_date; ?>">
					<font class="form_error"><?php if($message_position == 2) echo $message; ?></font>
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Artigo:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<select name="p_page_arti_id" onchange="QueryNumber();">
						<option value="">Selecione</option>

<?php

	$article = new Article();
	$article->SetDatabase($database);
	$result = $article->Select();
	
	while ($data = $database->FetchArray($result))
	{
		$arti_id = $data["arti_id"];
		$arti_title = $data["arti_title"];
		
		if($page_arti_id == $arti_id)
		{
			echo "<option value=\"".$arti_id."\" selected>".$arti_title."</option>";
		}
		else
		{
			echo "<option value=\"".$arti_id."\">".$arti_title."</option>";
		}
	}

?>
					
					</select>
					<font class="form_error"><?php if($message_position == 3) echo $message; ?></font>
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Número:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<input type="text" name="p_page_number" value="<?php echo $page_number; ?>">
					<font class="form_error"><?php if($message_position == 1) echo $message; ?></font>
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Usuário:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<select name="p_page_user_id">
						<option value="">Selecione</option>

<?php

	$user = new User();
	$user->SetDatabase($database);
	$result = $user->Select();
	
	while ($data = $database->FetchArray($result))
	{
		$user_id = $data["user_id"];
		$user_username = $data["user_username"];
		
		if($page_user_id == $user_id)
		{
			echo "<option value=\"".$user_id."\" selected>".$user_username."</option>";
		}
		else
		{
			echo "<option value=\"".$user_id."\">".$user_username."</option>";
		}
	}

?>
					
					</select>
					<font class="form_error"><?php if($message_position == 4) echo $message; ?></font>
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="100%" valign="center" align="center" colspan="2">

<?php

	if($page_id != "")
	{

?>				
				
					<a href="javascript:Update();">Atualizar</a>&nbsp;
					<a href="javascript:Delete();">Excluir</a>&nbsp;

<?php

	}
	else
	{

?>				
					<a href="javascript:Query();">Consultar</a>&nbsp;
					<a href="javascript:Insert();">Incluir</a>&nbsp;

<?php

	}

?>				

					<a href="javascript:Clear();">Limpar</a>
					<a href="/schifers/pages/pgRestricted.php">Voltar</a>
					<a href="/schifers/pages/pgParagraph.php">Parágrafo</a>
				
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="100%" valign="center" align="center" colspan="2">
					<font color="#FF0000">
<?php

	if($message != "" && $message_position == 5)
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
