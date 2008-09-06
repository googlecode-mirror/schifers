<?php

	/*
	* pgMessageQuery.php
	*
	* MessageQuery.
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
	require '../../'.$WEB_SITE.'src/cdGuardian.php';
	require '../../'.$WEB_SITE.'src/cdTopic.php';
	
?>

<html>
	<head>
		<title>Schifer's</title>
		<link rel="stylesheet" type="text/css" href="/schifers/css/schifers.css">
		<script language="Javascript">
			
			function Select()
			{
				window.opener.form_admin.p_mess_id.value = document.form_query.p_mess_id.options[document.form_query.p_mess_id.options.selectedIndex].value;
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
			<input type="hidden" name="p_action" value="<?php echo $action; ?>">
			<tr>
				<td bgcolor="#EEEEEE" width="100%" valign="top" class="form_title" colspan="2">
				Mensagens
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Tópico:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<select name="p_topc_id">
						<option value="">Selecione</option>

<?php

	$topic = new Topic();
	$topic->SetDatabase($database);
	$result = $topic->Select();
	
	while ($data = $database->FetchArray($result))
	{
		$topc_id = $data["topc_id"];
		$topc_text = $data["topc_text"];
		
		echo "<option value=\"".$topc_id."\">".$topc_text."</option>";
	}

?>
					
					</select>
					<font class="form_error"><?php if($message_position == 3) echo $message; ?></font>
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Mensagem:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<select name="p_mess_id">
						<option value="">Selecione</option>

<?php

	$result = "";
	$message = new Message();
	$message->SetDatabase($database);
	
	if($topc_id != "")
	{
		$message->SetTopic($mess_topc_id);
		$result = $message->SelectByTopic();
	}
	
	while ($data = $database->FetchArray($result))
	{
		$date = new Date();
		$date->SetDate($data["mess_date"]);
		$date->ConverToFullDisplay();
		
		$mess_id = $data["mess_id"];
		$mess_date = $date->GetConverted();
		
		echo "<option value=\"".$mess_id."\">".$mess_date."</option>";
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
