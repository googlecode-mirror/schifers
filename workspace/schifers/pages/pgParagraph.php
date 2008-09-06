<?php

	/*
	* pgParagraph.php
	*
	* Paragraph.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: August 04, 2007
	*/
	
	$module_name = "paragraph";

	require '../../schifers/constants/cdConstants.php';
	require '../../'.$WEB_SITE.'src/cdDatabase.php';
	require '../../'.$WEB_SITE.'src/cdDate.php';
	require '../../'.$WEB_SITE.'src/cdParagraph.php';
	require '../../'.$WEB_SITE.'src/cdUser.php';
	require '../../'.$WEB_SITE.'src/cdSession.php';
	require '../../'.$WEB_SITE.'src/cdArticle.php';
	require '../../'.$WEB_SITE.'src/cdPage.php';
	require '../../'.$WEB_SITE.'src/cdGuardian.php';
	
	$screen_module_name = "Parágrafo";
	$message_position = 0;

	if(!isset($_POST["p_para_user_id"]))
	{
		$para_user_id = $guardian->GetUserId();
	}

	if(!isset($_POST["p_para_date"]))
	{
		$date = new Date();
		$para_date = $date->GetNowFull();
	}

	if(isset($_POST["p_action"]))
	{
		$action = $_POST["p_action"];
		$para_id = $_POST["p_para_id"];
		$para_text = $_POST["p_para_text"];
		$para_date = $_POST["p_para_date"];
		$para_order = $_POST["p_para_order"];
		$para_user_id = $_POST["p_para_user_id"];
		$para_page_id = $_POST["p_para_page_id"];
		$message = "";
		
		if($para_user_id == "")
		{
			$para_user_id = $guardian->GetUserId();
		}

		if($para_date == "")
		{
			$date = new Date();
			$para_date = $date->GetNowFull();
		}

		if($action == 1)
		{
			$paragraph = new Paragraph();
			$paragraph->SetDatabase($database);
			$paragraph->SetId($para_id);
			$paragraph->SelectById();
			
			$date = new Date();
			$date->SetDate($paragraph->GetDate());
			$date->ConvertToFullDisplay();

			$para_id = $paragraph->GetId();
			$para_text = $paragraph->GetText();
			$para_date = $date->GetConverted();
			$para_order = $paragraph->GetOrder();
			$para_user_id = $paragraph->GetUser();
			$para_page_id = $paragraph->GetPage();
			
			if($para_id == "")
			{
				$message_position = 6;
				$message = $screen_module_name." não encontrado.";
				$para_id = "";
				$para_text = "";
				$para_date = $date->GetNowFull();
				$para_order = "";
				$para_user_id = $guardian->GetUserId();
				$para_page_id = "";
			}
		}
		
		if($action == 2)
		{
			$date = new Date();
			$date->SetConverted($para_date);
			$date->ConvertToFullDate();
			
			if($date->VerifyDate())
			{
				$message = $date->GetMessage();
				$message_position = 2;
			}
			else
			{
				$paragraph = new Paragraph();
				$paragraph->SetDatabase($database);
				$paragraph->SetText(str_replace("\"", "\\\"", $para_text));
				$paragraph->SetDate($date->GetDate());
				$paragraph->SetOrder($para_order);
				$paragraph->SetUser($para_user_id);
				$paragraph->SetPage($para_page_id);
			
				if($paragraph->Insert())
				{			
					$message_position = 6;
					$message = $screen_module_name." incluído com sucesso.";
					$para_id = "";
					$para_text = "";
					$para_date = $date->GetNowFull();
					$para_order = "";
					$para_user_id = $guardian->GetUserId();
					$para_page_id = "";
				}
				else
				{
					$message_position = 6;
					$message = "Problemas na operação.";
				}
			}
		}

		if($action == 3)
		{
			$date = new Date();
			$date->SetConverted($para_date);
			$date->ConvertToFullDate();
			
			if($date->VerifyDate())
			{
				$message = $date->GetMessage();
				$message_position = 2;
			}
			else
			{
				$paragraph = new Paragraph();
				$paragraph->SetDatabase($database);
				$paragraph->SetId($para_id);
				$paragraph->SetText(str_replace("\"", "\\\"", $para_text));
				$paragraph->SetDate($date->GetDate());
				$paragraph->SetOrder($para_order);
				$paragraph->SetUser($para_user_id);
				$paragraph->SetPage($para_page_id);
				
				if($paragraph->Update())
				{			
					$message_position = 6;
					$message = $screen_module_name." alterado com sucesso.";
				}
				else
				{
					$message_position = 6;
					$message = "Problemas na operação.";
				}
			}
		}

		if($action == 4)
		{
			$paragraph = new Paragraph();
			$paragraph->SetDatabase($database);
			$paragraph->SetId($para_id);
			
			if($paragraph->Delete())
			{			
				$date = new Date();

				$message_position = 6;
				$message = $screen_module_name." excluído com sucesso.";
				$para_id = "";
				$para_text = "";
				$para_date = $date->GetNowFull();
				$para_order = "";
				$para_user_id = $guardian->GetUserId();
				$para_page_id = "";
			}
			else
			{
				$message_position = 6;
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
			
			function QueryOrder()
			{
				document.all.ifr_general.src = "../actions/doQueryOrder.php?p_para_page_id=" + document.form_admin.p_para_page_id.options[document.form_admin.p_para_page_id.options.selectedIndex].value;
			}
			
			function Clear()
			{
				document.form_admin.p_para_id.value = "";
				document.form_admin.p_para_text.value = "";
				document.form_admin.p_para_date.value = "";
				document.form_admin.p_para_order.value = "";
				document.form_admin.p_para_user_id.selectedIndex = 0;
				document.form_admin.p_para_page_id.selectedIndex = 0;
				document.form_admin.p_action.value = "";
				document.form_admin.submit();
			}
			
			function Query()
			{
				window.open("pgParagraphQuery.php", "queryParagraph", "width=600,height=500,top=150,left=150,toolbar=0,location=0,status=0,menubar=0,scrollbars=1,resizable=1");
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
			<input type="hidden" name="p_para_id" value="<?php echo $para_id; ?>">
			<tr>
				<td bgcolor="#EEEEEE" width="100%" valign="top" class="form_title" colspan="2">
				Parágrafos
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Texto:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<textarea cols="40" rows="5" name="p_para_text"><?php echo $para_text; ?></textarea>
					<font class="form_error"><?php if($message_position == 1) echo $message; ?></font>
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Data:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<input type="text" name="p_para_date" value="<?php echo $para_date; ?>">
					<font class="form_error"><?php if($message_position == 2) echo $message; ?></font>
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Página:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<select name="p_para_page_id" onchange="QueryOrder();">
						<option value="">Selecione</option>

<?php

	$page = new Page();
	$page->SetDatabase($database);
	$result = $page->SelectOrderedByArticleTitleAndPageNumber();
	
	while ($data = $database->FetchArray($result))
	{
		$page_id = $data["page_id"];
		$page_number = $data["page_number"];
		$arti_title = $data["arti_title"];
		
		
		if($para_page_id == $page_id)
		{
			echo "<option value=\"".$page_id."\" selected>".$page_number." - ".$arti_title."</option>";
		}
		else
		{
			echo "<option value=\"".$page_id."\">".$page_number." - ".$arti_title."</option>";
		}
	}

?>
					
					</select>
					<font class="form_error"><?php if($message_position == 4) echo $message; ?></font>
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Ordem:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<input type="text" name="p_para_order" value="<?php echo $para_order; ?>">
					<font class="form_error"><?php if($message_position == 3) echo $message; ?></font>
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Usuário:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<select name="p_para_user_id">
						<option value="">Selecione</option>

<?php

	$user = new User();
	$user->SetDatabase($database);
	$result = $user->Select();
	
	while ($data = $database->FetchArray($result))
	{
		$user_id = $data["user_id"];
		$user_username = $data["user_username"];
		
		if($para_user_id == $user_id)
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
					<font class="form_error"><?php if($message_position == 5) echo $message; ?></font>
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="100%" valign="center" align="center" colspan="2">

<?php

	if($para_id != "")
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
					<a href="/schifers/pages/pgPage.php">Página</a>
				
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="100%" valign="center" align="center" colspan="2">
					<font color="#FF0000">
<?php

	if($message != "" && $message_position == 6)
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
