<?php

	/*
	* pgArticle.php
	*
	* Article.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: August 04, 2007
	*/

	$module_name = "article";

	require '../../schifers/constants/cdConstants.php';
	require '../../'.$WEB_SITE.'src/cdDatabase.php';
	require '../../'.$WEB_SITE.'src/cdDate.php';
	require '../../'.$WEB_SITE.'src/cdUser.php';
	require '../../'.$WEB_SITE.'src/cdArea.php';
	require '../../'.$WEB_SITE.'src/cdSubject.php';
	require '../../'.$WEB_SITE.'src/cdArticle.php';
	require '../../'.$WEB_SITE.'src/cdPage.php';
	require '../../'.$WEB_SITE.'src/cdSession.php';
	require '../../'.$WEB_SITE.'src/cdGuardian.php';

	$screen_module_name = "Artigo";
	$message_position = 0;

	if(!isset($_POST["p_arti_user_id"]))
	{
		$arti_user_id = $guardian->GetUserId();
	}

	if(isset($_POST["p_action"]))
	{
		$action = $_POST["p_action"];
		$arti_id = $_POST["p_arti_id"];
		$arti_title = $_POST["p_arti_title"];
		$arti_date = $_POST["p_arti_date"];
		$arti_user_id = $_POST["p_arti_user_id"];
		$arti_subj_id = $_POST["p_arti_subj_id"];
		$message = "";
		
		if($action == 1)
		{
			$article = new Article();
			$article->SetDatabase($database);
			$article->SetId($arti_id);
			$article->SelectById();
			
			$date = new Date();
			$date->SetDate($article->GetDate());
			$date->ConvertToDisplay();

			$arti_id = $article->GetId();
			$arti_title = $article->GetTitle();
			$arti_date = $date->GetConverted();
			$arti_user_id = $article->GetUser();
			$arti_subj_id = $article->GetSubject();

			if($arti_id == "")
			{
				$date = new Date();

				$message_position = 5;
				$message = $screen_module_name." não encontrado.";
				$arti_id = "";
				$arti_title = "";
				$arti_date = $date->GetNowFull();
				$arti_user_id = "";
				$arti_subj_id = "";
			}
		}
		
		if($action == 2)
		{
			$date = new Date();
			$date->SetConverted($arti_date);
			$date->ConvertToDate();
			
			if($date->VerifyDate())
			{
				$message = $date->GetMessage();
				$message_position = 2;
			}
			else
			{
				$article = new Article();
				$article->SetDatabase($database);
				$article->SetTitle($arti_title);
				$article->SetDate($date->GetDate());
				$article->SetUser($arti_user_id);
				$article->SetSubject($arti_subj_id);

				if($article->Insert())
				{			
					$date = new Date();

					$message_position = 5;
					$message = $screen_module_name." incluído com sucesso.";
					$arti_id = "";
					$arti_title = "";
					$arti_date = $date->GetNowFull();
					$arti_user_id = "";
					$arti_subj_id = "";
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
			$date->SetDate($arti_date);
			$date->ConvertToDate();
			
			if($date->VerifyDate())
			{
				$message = $date->GetMessage();
				$message_position = 2;
			}
			else
			{
				$article = new Article();
				$article->SetDatabase($database);
				$article->SetId($arti_id);
				$article->SetTitle($arti_title);
				$article->SetDate($date->GetDate());
				$article->SetUser($arti_user_id);
				$article->SetSubject($arti_subj_id);
			
				if($article->Update())
				{			
					$message_position = 5;
					$message = $screen_module_name." alterado com sucesso.";
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
			$article = new Article();
			$article->SetDatabase($database);
			$article->SetId($arti_id);
			
			if($article->Delete())
			{			
				$message_position = 5;
				$message = $screen_module_name." excluído com sucesso.";
				$arti_id = "";
				$arti_title = "";
				$arti_date = "";
				$arti_user_id = "";
				$arti_subj_id = "";
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
			
			function Clear()
			{
				document.form_admin.p_arti_id.value = "";
				document.form_admin.p_arti_title.value = "";
				document.form_admin.p_arti_date.value = "";
				document.form_admin.p_arti_user_id.selectedIndex = 0;
				document.form_admin.p_arti_subj_id.selectedIndex = 0;
				document.form_admin.p_action.value="0";
				document.form_admin.submit();
			}
			
			function Query()
			{
				window.open("pgArticleQuery.php", "queryArticle", "width=600,height=500,top=150,left=150,toolbar=0,location=0,status=0,menubar=0,scrollbars=1,resizable=1");
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
			<input type="hidden" name="p_arti_id" value="<?php echo $arti_id; ?>">
			<tr>
				<td bgcolor="#EEEEEE" width="100%" valign="top" class="form_title" colspan="2">
				Artigos
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Título:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<input type="text" name="p_arti_title" value="<?php echo $arti_title; ?>">
					<font class="form_error"><?php if($message_position == 1) echo $message; ?></font>
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Data:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<input type="text" name="p_arti_date" value="<?php echo $arti_date; ?>">
					<font class="form_error"><?php if($message_position == 2) echo $message; ?></font>
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Assunto:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<select name="p_arti_subj_id">
						<option value="">Selecione</option>

<?php

	$subject = new Subject();
	$subject->SetDatabase($database);
	$result = $subject->Select();
	
	while ($data = $database->FetchArray($result))
	{
		$subj_id = $data["subj_id"];
		$subj_name = $data["subj_name"];
		$subj_area_id = $data["subj_area_id"];
		
		$area = new Area();
		$area->SetDatabase($database);
		$area->SetId($subj_area_id);
		$area->SelectById();
	
		if($arti_subj_id == $subj_id)
		{
			echo "<option value=\"".$subj_id."\" selected>".$subj_name." (".$area->GetName().")</option>";
		}
		else
		{
			echo "<option value=\"".$subj_id."\">".$subj_name." (".$area->GetName().")</option>";
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
					<select name="p_arti_user_id">
						<option value="">Selecione</option>

<?php

	$user = new User();
	$user->SetDatabase($database);
	$result = $user->Select();
	
	while ($data = $database->FetchArray($result))
	{
		$user_id = $data["user_id"];
		$user_username = $data["user_username"];
		
		if($arti_user_id == $user_id)
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

	if($arti_id != "")
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
