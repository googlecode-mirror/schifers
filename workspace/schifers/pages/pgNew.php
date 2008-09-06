<?php

	/*
	* pgNew.php
	*
	* New.
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
	
	$screen_module_name = "Notícia";

	if(isset($_POST["p_action"]))
	{
		$action = $_POST["p_action"];
		$news_id = $_POST["p_news_id"];
		$news_title = $_POST["p_news_title"];
		$news_date = $_POST["p_news_date"];
		$news_text = $_POST["p_news_text"];
		$news_user_id = $_POST["p_news_user_id"];
		$message = "";

		if($action == 1)
		{
			$news = new News();
			$news->SetDatabase($database);
			$news->SetId($news_id);
			$news->SelectById();
			
			$date = new Date();
			$date->SetDate($news->GetDate());
			$date->ConvertToFullDisplay();
			
			$news_id = $news->GetId();
			$news_title = $news->GetTitle();
			$news_date = $date->GetConverted();
			$news_text = $news->GetText();
			$news_user_id = $news->GetUser();
			
			if($news_id == "")
			{
				$message = $screen_module_name." não encontrada.";
				$news_id = "";
				$news_title = "";
				$news_date = "";
				$news_text = "";
				$news_user_id = "";
			}
		}
		
		if($action == 2)
		{
			$date = new Date();
			$date->SetConverted($news_date);
			$date->ConvertToFullDate();

			$news = new News();

			$news->SetDatabase($database);
			$news->SetTitle($news_title);
			$news->SetDate($date->GetDate());
			$news->SetText($news_text);
			$news->SetUser($news_user_id);
			
			if($news->Insert())
			{			
				$message = $screen_module_name." incluída com sucesso.";
				$news_id = "";
				$news_title = "";
				$news_date = $date->GetNowFull();
				$news_text = "";
				$news_user_id = "";
			}
			else
			{
				$message = "Problemas na operação.";
			}
		}

		if($action == 3)
		{
			$date = new Date();
			$date->SetConverted($news_date);
			$date->ConvertToFullDate();

			$news = new News();
			$news->SetDatabase($database);
			$news->SetId($news_id);
			$news->SetTitle($news_title);
			$news->SetDate($date->GetDate());
			$news->SetText($news_text);
			$news->SetUser($news_user_id);
			
			$news_id = $news->GetId();
			$news_title = $news->GetTitle();
			$news_date = $news->GetDate();
			$news_text = $news->GetText();
			$news_user_id = $news->GetUser();

			if($news->Update())
			{			
				$message = $screen_module_name." alterada com sucesso.";
			}
			else
			{
				$message = "Problemas na operação.";
			}
		}

		if($action == 4)
		{
			$date = new Date();

			$news = new News();
			$news->SetDatabase($database);
			$news->SetId($news_id);
			
			if($news->Delete())
			{			
				$message = $screen_module_name." excluída com sucesso.";
				$news_id = "";
				$news_title = "";
				$news_date = $date->GetNowFull();
				$news_text = "";
				$news_user_id = "";
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
				document.form_admin.p_news_id.value = "";
				document.form_admin.p_news_title.value = "";
				document.form_admin.p_news_text.value = "";
				document.form_admin.p_news_date.value = "";
				document.form_admin.p_news_user_id.selectedIndex = 0;
				document.form_admin.p_action.value="0";
				document.form_admin.submit();
			}
			
			function Query()
			{
				window.open("pgNewQuery.php", "queryNew", "width=600,height=500,top=150,left=150,toolbar=0,location=0,status=0,menubar=0,scrollbars=1,resizable=1");
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

<?php

	$date = new Date();
	if($news_date == "")
	{
		$news_date = $date->GetNowFull();
	}
	
?>

	<table width="100%" cellspacing="1" bgcolor="#000000">
		<form name="form_admin" method="post">
			<input type="hidden" name="p_action">
			<input type="hidden" name="p_news_id" value="<?php echo $news_id; ?>">
			<input type="hidden" name="p_news_date" value="<?php echo $news_date; ?>">
			
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
					<input type="text" name="p_news_title" value="<?php echo $news_title; ?>">
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Data:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<?php echo $news_date; ?>
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Text:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<textarea name="p_news_text" rows="5" cols="70"><?php echo $news_text; ?></textarea>
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Usuário:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<select name="p_news_user_id">
						<option value="">Selecione</option>

<?php

	$user = new User();
	$user->SetDatabase($database);
	$result = $user->Select();
	
	while ($data = $database->FetchArray($result))
	{
		$user_id = $data["user_id"];
		$user_username = $data["user_username"];
		
		if($news_user_id == $user_id)
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
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="100%" valign="center" align="center" colspan="2">

<?php

	if($news_id != "")
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
