<?php

	/*
	* pgParagraphQuery.php
	*
	* ParagraphQuery.
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
	require '../../'.$WEB_SITE.'src/cdGuardian.php';
	require '../../'.$WEB_SITE.'src/cdSubject.php';
	require '../../'.$WEB_SITE.'src/cdArticle.php';
	require '../../'.$WEB_SITE.'src/cdPage.php';

	if(isset($_POST["p_action"]))
	{
		$action = $_POST["p_action"];
		$subj_id = $_POST["p_subj_id"];
		$arti_id = $_POST["p_arti_id"];
		$para_page_id = $_POST["p_para_page_id"];
	}

?>

<html>
	<head>
		<title>Schifer's</title>
		<link rel="stylesheet" type="text/css" href="/schifers/css/schifers.css">
		<script language="Javascript">
			
			function Select()
			{
				window.opener.form_admin.p_para_id.value = document.form_query.p_para_id.options[document.form_query.p_para_id.options.selectedIndex].value;
				window.opener.form_admin.p_action.value="1";
				window.opener.form_admin.submit();
				Close();
			}
			
			function Close()
			{
				window.close();
			}
			
			function QueryArticle()
			{
				document.form_query.p_action.value = "1";
				document.form_query.action = "../pages/pgParagraphQuery.php";
				document.form_query.submit();
			}
			
			function QueryPage()
			{
				document.form_query.p_action.value = "2";
				document.form_query.action = "../pages/pgParagraphQuery.php";
				document.form_query.submit();
			}
			
			function QueryParagraph()
			{
				document.form_query.p_action.value = "3";
				document.form_query.action = "../pages/pgParagraphQuery.php";
				document.form_query.submit();
			}
			
		</script>
	</head>
	
	<body bgcolor="#FFFFFF">

	<table width="100%" cellspacing="1" bgcolor="#000000">
		<form name="form_query" method="post">
			<input type="hidden" name="p_action" value="<?php echo $action; ?>">
			<input type="hidden" name="p_subj_id" value="<?php echo $subj_id; ?>">
			<input type="hidden" name="p_arti_id" value="<?php echo $arti_id; ?>">
			<input type="hidden" name="p_para_page_id" value="<?php echo $para_page_id; ?>">
			<tr>
				<td bgcolor="#EEEEEE" width="100%" valign="top" class="form_title" colspan="2">
				Parágrafos
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Assunto:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<select name="p_subj_id" onchange="QueryArticle();">
						<option value="">Selecione</option>

<?php

	$subject = new Subject();
	$subject->SetDatabase($database);
	$result = $subject->Select();
	
	while ($data = $database->FetchArray($result))
	{
		$t_subj_id = $data["subj_id"];
		$subj_name = $data["subj_name"];
		
		if($subj_id == $t_subj_id)
		{
			echo "<option value=\"".$t_subj_id."\" selected>".$subj_name."</option>";
		}
		else
		{
			echo "<option value=\"".$t_subj_id."\">".$subj_name."</option>";
		}
	}

?>
					
					</select>
					<font class="form_error"><?php if($message_position == 3) echo $message; ?></font>
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Artigo:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<select name="p_arti_id" onchange="QueryPage();">
						<option value="">Selecione</option>

<?php

	$result = "";
	$article = new Article();
	$article->SetDatabase($database);

	if($subj_id != "")
	{
		$article->SetSubject($subj_id);
		$result = $article->SelectBySubject();
	}
	
	while ($data = $database->FetchArray($result))
	{
		$t_arti_id = $data["arti_id"];
		$arti_title = $data["arti_title"];
		
		if($t_arti_id == $arti_id)
		{
			echo "<option value=\"".$t_arti_id."\" selected>".$arti_title."</option>";
		}
		else
		{
			echo "<option value=\"".$t_arti_id."\">".$arti_title."</option>";
		}
	}

?>
					
					</select>
					<font class="form_error"><?php if($message_position == 4) echo $message; ?></font>
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Página:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<select name="p_para_page_id" onchange="QueryParagraph();">
						<option value="">Selecione</option>

<?php

	$result = "";
	$page = new Page();
	$page->SetDatabase($database);
	
	if($arti_id != "")
	{
		$page->SetArticle($arti_id);
		$result = $page->SelectByArticle();
	}
	
	while ($data = $database->FetchArray($result))
	{
		$page_id = $data["page_id"];
		$page_number = $data["page_number"];
		
		if($para_page_id == $page_id)
		{
			echo "<option value=\"".$page_id."\" selected>".$page_number."</option>";
		}
		else
		{
			echo "<option value=\"".$page_id."\">".$page_number."</option>";
		}
	}

?>
					
					</select>
					<font class="form_error"><?php if($message_position == 4) echo $message; ?></font>
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Id:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<select name="p_para_id">
						<option value="">Selecione</option>

<?php

	$result = "";
	$paragraph = new Paragraph();
	$paragraph->SetDatabase($database);
	
	if($para_page_id != "")
	{
		$paragraph->SetPage($para_page_id);
		$result = $paragraph->SelectByPage();
	}
	
	while ($data = $database->FetchArray($result))
	{
		$para_id = $data["para_id"];
		$para_order = $data["para_order"];
		
		echo "<option value=\"".$para_id."\">".$para_order."</option>";
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
