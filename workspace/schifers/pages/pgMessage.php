<?php

	/*
	* pgMessage.php
	*
	* Message.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: August 04, 2007
	*/
	
	$module_name = "message";

	require '../../schifers/constants/cdConstants.php';
	require '../../'.$WEB_SITE.'src/cdDatabase.php';
	require '../../'.$WEB_SITE.'src/cdDate.php';
	require '../../'.$WEB_SITE.'src/cdMessage.php';
	require '../../'.$WEB_SITE.'src/cdUser.php';
	require '../../'.$WEB_SITE.'src/cdSession.php';
	require '../../'.$WEB_SITE.'src/cdTopic.php';
	require '../../'.$WEB_SITE.'src/cdGuardian.php';
	
	$screen_module_name = "Mensagem";
	$message_position = 0;

	if(!isset($_POST["p_mess_user_id"]))
	{
		$mess_user_id = $guardian->GetUserId();
	}

	if(!isset($_POST["p_mess_date"]))
	{
		$date = new Date();
		$mess_date = $date->GetNowFull();
	}

	if(isset($_POST["p_action"]))
	{
		$action = $_POST["p_action"];
		$mess_id = $_POST["p_mess_id"];
		$mess_text = $_POST["p_mess_text"];
		$mess_date = $_POST["p_mess_date"];
		$mess_user_id = $_POST["p_mess_user_id"];
		$mess_topc_id = $_POST["p_mess_topc_id"];
		$message = "";
		
		if($mess_user_id == "")
		{
			$mess_user_id = $guardian->GetUserId();
		}

		if($mess_date == "")
		{
			$date = new Date();
			$mess_date = $date->GetNowFull();
		}

		if($action == 1)
		{
			$message = new Message();
			$message->SetDatabase($database);
			$message->SetId($mess_id);
			$message->SelectById();
			
			$date = new Date();
			$date->SetDate($message->GetDate());
			$date->ConvertToFullDisplay();

			$mess_id = $message->GetId();
			$mess_text = $message->GetText();
			$mess_date = $date->GetConverted();
			$mess_user_id = $message->GetUser();
			$mess_topc_id = $message->GetTopic();
			
			if($mess_id == "")
			{
				$message_position = 6;
				$message = $screen_module_name." não encontrado.";
				$mess_id = "";
				$mess_text = "";
				$mess_date = $date->GetFullNow();
				$mess_user_id = $guardian->GetUserId();
				$mess_topc_id = "";
			}
		}
		
		if($action == 2)
		{
			$date = new Date();
			$date->SetDate($mess_date);
			$date->ConverToFullDate();
			
			if($date->VerifyDate())
			{
				$message = $date->GetMessage();
				$message_position = 2;
			}
			else
			{
				$message = new Message();
				$message->SetDatabase($database);
				$message->SetText(str_replace("\"", "\\\"", $mess_text));
				$message->SetDate($date->GetDate());
				$message->SetUser($mess_user_id);
				$message->SetTopic($mess_topc_id);
			
				if($message->Insert())
				{			
					$message_position = 6;
					$message = $screen_module_name." incluído com sucesso.";
					$mess_id = "";
					$mess_text = "";
					$mess_date = $date->GetNowFull();
					$mess_user_id = $guardian->GetUserId();
					$mess_topc_id = "";
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
			$date->SetDate($mess_date);
			$date->ConverToFullDate();
			
			if($date->VerifyDate())
			{
				$message = $date->GetMessage();
				$message_position = 2;
			}
			else
			{
				$message = new Message();
				$message->SetDatabase($database);
				$message->SetId($mess_id);
				$message->SetText(str_replace("\"", "\\\"", $mess_text));
				$message->SetDate($date->GetDate());
				$message->SetUser($mess_user_id);
				$message->SetTopic($mess_topc_id);
				
				if($message->Update())
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
			$message = new Message();
			$message->SetDatabase($database);
			$message->SetId($mess_id);
			
			if($message->Delete())
			{			
				$message_position = 6;
				$message = $screen_module_name." excluído com sucesso.";
				$mess_id = "";
				$mess_text = "";
				$mess_date = $date->GetNowFull();
				$mess_user_id = $guardian->GetUserId();
				$mess_topc_id = "";
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
			
			function Clear()
			{
				document.form_admin.p_mess_id.value = "";
				document.form_admin.p_mess_text.value = "";
				document.form_admin.p_mess_date.value = "";
				document.form_admin.p_mess_user_id.selectedIndex = 0;
				document.form_admin.p_mess_topc_id.selectedIndex = 0;
				document.form_admin.p_action.value = "";
				document.form_admin.submit();
			}
			
			function Query()
			{
				window.open("pgMessageQuery.php", "queryMessage", "width=600,height=500,top=150,left=150,toolbar=0,location=0,status=0,menubar=0,scrollbars=1,resizable=1");
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
			<input type="hidden" name="p_mess_id" value="<?php echo $mess_id; ?>">
			<tr>
				<td bgcolor="#EEEEEE" width="100%" valign="top" class="form_title" colspan="2">
				Tópicos
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Texto:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<textarea cols="40" rows="5" name="p_mess_text"><?php echo $mess_text; ?></textarea>
					<font class="form_error"><?php if($message_position == 1) echo $message; ?></font>
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Data:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<input type="text" name="p_mess_date" value="<?php echo $mess_date; ?>">
					<font class="form_error"><?php if($message_position == 2) echo $message; ?></font>
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Tópico:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<select name="p_mess_topc_id" onchange="QueryOrder();">
						<option value="">Selecione</option>

<?php

	$topic = new Topic();
	$topic->SetDatabase($database);
	$result = $topic->Select();
	
	while ($data = $database->FetchArray($result))
	{
		$topc_id = $data["topc_id"];
		$topc_text = $data["topc_text"];
		
		if($mess_topc_id == $topc_id)
		{
			echo "<option value=\"".$topc_id."\" selected>".$topc_text."</option>";
		}
		else
		{
			echo "<option value=\"".$topc_id."\">".$topc_text."</option>";
		}
	}

?>
					
					</select>
					<font class="form_error"><?php if($message_position == 3) echo $message; ?></font>
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Usuário:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<select name="p_mess_user_id">
						<option value="">Selecione</option>

<?php

	$user = new User();
	$user->SetDatabase($database);
	$result = $user->Select();
	
	while ($data = $database->FetchArray($result))
	{
		$user_id = $data["user_id"];
		$user_username = $data["user_username"];
		
		if($mess_user_id == $user_id)
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

	if($mess_id != "")
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
