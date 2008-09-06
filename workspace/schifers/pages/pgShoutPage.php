<?php

	/*
	* pgShoutPage.php
	*
	* Shout page.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: September 18, 2007
	*/

	$module_name = "shout_page";

	require '../../schifers/constants/cdConstants.php';
	require '../../'.$WEB_SITE.'src/cdDatabase.php';
	require '../../'.$WEB_SITE.'src/cdDate.php';
	require '../../'.$WEB_SITE.'src/cdShout.php';
	require '../../'.$WEB_SITE.'src/cdUser.php';
	require '../../'.$WEB_SITE.'src/cdSession.php';
	require '../../'.$WEB_SITE.'src/cdGuardian.php';

	$screen_module_name = "Grito da Galera";

	$user_tmp = new User();
	$user_tmp->SetDatabase($database);
	$user_tmp->SetUsername($guardian->GetUsername());
	$user_tmp->SelectByName();
	
	$user_id_tmp = $user_tmp->GetId();
	
	if(isset($_POST["p_action"]))
	{
		$action = $_POST["p_action"];
		$shou_id = $_POST["p_shou_id"];
		$shou_date = $_POST["p_shou_date"];
		$shou_text = $_POST["p_shou_text"];
		$shou_user_id = $_POST["p_shou_user_id"];
		$message = "";

		if($action == 1)
		{
			$date = new Date();
			$date->SetConverted($shou_date);
			$date->ConvertToFullDate();

			$shout = new Shout();
			$shout->SetDatabase($database);
			$shout->SetDate($date->GetDate());
			$shout->SetText($shou_text);
			$shout->SetUser($shou_user_id);
			
			if($shout->Insert())
			{			
				$message = $screen_module_name." incluído com sucesso.";
				$shou_id = "";
				$shou_date = $date->GetNowFull();
				$shou_text = "";
				$shou_user_id = "";
			}
			else
			{
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
				document.form_admin.p_shou_id.value = "";
				document.form_admin.p_shou_text.value = "";
				document.form_admin.p_shou_user_id.selectedIndex = 0;
				document.form_admin.p_action.value="0";
				document.form_admin.submit();
			}
			
			function Insert()
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

<?php
	if($shou_date == "")
	{
		$date = new Date();
		$shou_date = $date->GetNowFull();
	}
?>

	<table width="100%" cellspacing="1" bgcolor="#000000">
		<form name="form_admin" method="post">
			<input type="hidden" name="p_action">
			<input type="hidden" name="p_shou_id" value="<?php echo $shou_id; ?>">
			<input type="hidden" name="p_shou_date" value="<?php echo $shou_date; ?>">
			<input type="hidden" name="p_shou_user_id" value="<?php echo $user_tmp->GetId(); ?>">
			<tr>
				<td bgcolor="#EEEEEE" width="100%" valign="top" class="form_title" colspan="2">
				Grito da Galera
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Data:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<?php echo $shou_date; ?>
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Text:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<textarea name="p_shou_text" rows="5" cols="70"><?php echo $shou_text; ?></textarea>
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Usuário:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<?php echo $user_tmp->GetUsername(); ?>
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="100%" valign="center" align="center" colspan="2">
					<a href="javascript:Insert();">Incluir</a>&nbsp;
					<a href="javascript:Clear();">Limpar</a>
					<a href="/index.php">Voltar</a>
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="100%" valign="center" align="center" colspan="2">
					<font color="#FF0000">
<?php

	if($message != "")
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
