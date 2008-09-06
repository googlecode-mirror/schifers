<?php

	/*
	* pgTopic.php
	*
	* Topic.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: August 04, 2007
	*/
	
	$module_name = "topic";

	require '../../schifers/constants/cdConstants.php';
	require '../../'.$WEB_SITE.'src/cdDatabase.php';
	require '../../'.$WEB_SITE.'src/cdDate.php';
	require '../../'.$WEB_SITE.'src/cdUser.php';
	require '../../'.$WEB_SITE.'src/cdSession.php';
	require '../../'.$WEB_SITE.'src/cdGuardian.php';
	require '../../'.$WEB_SITE.'src/cdTopic.php';

	$screen_module_name = "Tópico";
	$message_position = 0;

	if(!isset($_POST["p_topc_user_id"]))
	{
		$topc_user_id = $guardian->GetUserId();
	}

	if(!isset($_POST["p_topc_date"]))
	{
		$date = new Date();
		$topc_date = $date->GetNowFull();
	}

	if(isset($_POST["p_action"]))
	{
		if($topc_user_id == "")
		{
			$topc_user_id = $guardian->GetUserId();
		}

		$action = $_POST["p_action"];
		$topc_id = $_POST["p_topc_id"];
		$topc_title = $_POST["p_topc_title"];
		$topc_text = $_POST["p_topc_text"];
		$topc_date = $_POST["p_topc_date"];
		$topc_level = $_POST["p_topc_level"];
		$topc_user_id = $_POST["p_topc_user_id"];
		$topc_topc_id = $_POST["p_topc_topc_id"];
		$message = "";
		
		if($topc_date == "")
		{
			$date = new Date();
			$topc_date = $date->GetNowFull();
		}

		if($action == 1)
		{
			$topic = new Topic();
			$topic->SetDatabase($database);
			$topic->SetId($topc_id);
			$topic->SelectById();
			
			$date = new Date();
			$date->SetDate($topc_date);
			$date->ConvertToDisplay();

			$topc_id = $topic->GetId();
			$topc_title = $topic->GetTitle();
			$topc_text = $topic->GetText();
			$topc_date = $date->GetConverted();
			$topc_level = $topic->GetLevel();
			$topc_user_id = $topic->GetUser();
			$topc_topc_id = $topic->GetTopic();

			if($topc_id == "")
			{
				$message_position = 7;
				$message = $screen_module_name." não encontrado.";
				$topc_id = "";
				$topc_title = "";
				$topc_text = "";
				$topc_date = $date->GetNow();
				$topc_level = "";
				$topc_user_id = $guardian->GetUserId();
				$topc_topc_id = "";
			}
		}
		
		if($action == 2)
		{
			$date = new Date();
			$date->SetConverted($topc_date);
			$date->ConvertToDate();
			
			if($date->VerifyDate())
			{
				$message = $date->GetMessage();
				$message_position = 2;
			}
			else
			{
				$topic = new Topic();
				$topic->SetDatabase($database);
				$topic->SetTitle(str_replace("\"", "\\\"", $topc_title));
				$topic->SetText(str_replace("\"", "\\\"", $topc_text));
				$topic->SetDate($date->GetDate());
				$topic->SetLevel($topc_level);
				$topic->SetUser($topc_user_id);
				$topic->SetTopic($topc_topc_id);

				if($topic->Insert())
				{			
					$message_position = 7;
					$message = $screen_module_name." incluído com sucesso.";
					$topc_id = "";
					$topc_title = "";
					$topc_text = "";
					$topc_date = $date->GetNow();
					$topc_level = "";
					$topc_user_id = $guardian->GetUserId();
					$topc_topc_id = "";
				}
				else
				{
					$message_position = 7;
					$message = "Problemas na operação.";
				}
			}
		}

		if($action == 3)
		{
			$date = new Date();
			$date->SetConverted($topc_date);
			$date->ConvertToDate();
			
			if($date->VerifyDate())
			{
				$message = $date->GetMessage();
				$message_position = 2;
			}
			else
			{
				$topic = new Topic();
				$topic->SetDatabase($database);
				$topic->SetId($topc_id);
				$topic->SetTitle(str_replace("\"", "\\\"", $topc_title));
				$topic->SetText(str_replace("\"", "\\\"", $topc_text));
				$topic->SetDate($date->GetDate());
				$topic->SetLevel($topc_level);
				$topic->SetUser($topc_user_id);
				$topic->SetTopic($topc_topc_id);
			
				if($topic->Update())
				{			
					$message_position = 7;
					$message = $screen_module_name." alterado com sucesso.";
				}
				else
				{
					$message_position = 7;
					$message = "Problemas na operação.";
				}
			}
		}

		if($action == 4)
		{
			$topic = new Topic();
			$topic->SetDatabase($database);
			$topic->SetId($topc_id);
			
			if($topic->Delete())
			{			
				$date = new Date();

				$message_position = 7;
				$message = $screen_module_name." excluído com sucesso.";
				$topc_id = "";
				$topc_title = "";
				$topc_text = "";
				$topc_date = $date->GetNow();
				$topc_level = "";
				$topc_user_id = $guardian->GetUserId();
				$topc_topc_id = "";
			}
			else
			{
				$message_position = 7;
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
			
			function Clear()
			{
				document.form_admin.p_topc_id.value = "";
				document.form_admin.p_topc_text.value = "";
				document.form_admin.p_topc_title.value = "";
				document.form_admin.p_topc_date.value = "";
				document.form_admin.p_topc_level.value = "";
				document.form_admin.p_topc_user_id.selectedIndex = 0;
				document.form_admin.p_topc_topc_id.selectedIndex = 0;
				document.form_admin.p_action.value = "";
				document.form_admin.submit();
			}
			
			function Query()
			{
				window.open("pgTopicQuery.php", "queryTopic", "width=600,height=500,top=150,left=150,toolbar=0,location=0,status=0,menubar=0,scrollbars=1,resizable=1");
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

	<table width="100%" cellspacing="1" bgcolor="#000000">
		<form name="form_admin" method="post">
			<input type="hidden" name="p_action">
			<input type="hidden" name="p_topc_id" value="<?php echo $topc_id; ?>">
			<tr>
				<td bgcolor="#EEEEEE" width="100%" valign="top" class="form_text" colspan="2">
				Tópicos
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Título:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<input type="text" size="100" maxlength="255" name="p_topc_title" value="<?php echo $topc_title; ?>">
					<font class="form_error"><?php if($message_position == 1) echo $message; ?></font>
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Texto:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<textarea cols="40" rows="5" name="p_topc_text"><?php echo $topc_text; ?></textarea>
					<font class="form_error"><?php if($message_position == 2) echo $message; ?></font>
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Data:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<input type="text" name="p_topc_date" value="<?php echo $topc_date; ?>">
					<font class="form_error"><?php if($message_position == 3) echo $message; ?></font>
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Nível:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<input type="text" name="p_topc_level" value="<?php echo $topc_level; ?>">
					<font class="form_error"><?php if($message_position == 4) echo $message; ?></font>
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Tópico:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<select name="p_topc_topc_id" onchange="QueryOrder();">
						<option value="">Selecione</option>

<?php

	$topic = new Topic();
	$topic->SetDatabase($database);
	$result = $topic->Select();
	
	while ($data = $database->FetchArray($result))
	{
		$t_topc_id = $data["topc_id"];
		$t_topc_title = $data["topc_title"];
		
		if($topc_topc_id == $t_topc_id)
		{
			echo "<option value=\"".$t_topc_id."\" selected>".$t_topc_title."</option>";
		}
		else
		{
			echo "<option value=\"".$t_topc_id."\">".$t_topc_title."</option>";
		}
	}

?>
					
					</select>
					<font class="form_error"><?php if($message_position == 5) echo $message; ?></font>
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Usuário:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<select name="p_topc_user_id">
						<option value="">Selecione</option>

<?php

	$user = new User();
	$user->SetDatabase($database);
	$result = $user->Select();
	
	while ($data = $database->FetchArray($result))
	{
		$user_id = $data["user_id"];
		$user_username = $data["user_username"];
		
		if($topc_user_id == $user_id)
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
					<font class="form_error"><?php if($message_position == 6) echo $message; ?></font>
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="100%" valign="center" align="center" colspan="2">

<?php

	if($topc_id != "")
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
				
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="100%" valign="center" align="center" colspan="2">
					<font color="#FF0000">
<?php

	if($message != "" && $message_position == 7)
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
