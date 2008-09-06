<?php

	/*
	* pgSubject.php
	*
	* Subject.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: August 04, 2007
	*/
	
	$module_name = "subject";

	require '../../schifers/constants/cdConstants.php';
	require '../../'.$WEB_SITE.'src/cdDatabase.php';
	require '../../'.$WEB_SITE.'src/cdDate.php';
	require '../../'.$WEB_SITE.'src/cdSubject.php';
	require '../../'.$WEB_SITE.'src/cdUser.php';
	require '../../'.$WEB_SITE.'src/cdSession.php';
	require '../../'.$WEB_SITE.'src/cdGuardian.php';
	require '../../'.$WEB_SITE.'src/cdArea.php';
	
	$screen_module_name = "Assunto";

	if(isset($_POST["p_action"]))
	{
		$action = $_POST["p_action"];
		$subj_id = $_POST["p_subj_id"];
		$subj_name = $_POST["p_subj_name"];
		$subj_area_id = $_POST["p_subj_area_id"];
		$message = "";

		if($action == 1)
		{
			$subject = new Subject();
			$subject->SetDatabase($database);
			$subject->SetId($subj_id);
			$subject->SelectById();
			
			$subj_id = $subject->GetId();
			$subj_name = $subject->GetName();
			$subj_area_id = $subject->GetArea();
			
			if($subj_id == "")
			{
				$message = $screen_module_name." não encontrado.";
				$subj_id = "";
				$subj_name = "";
				$subj_area_id = "";
			}
		}
		
		if($action == 2)
		{
			$subject = new Subject();
			$subject->SetDatabase($database);
			$subject->SetName($subj_name);
			$subject->SetArea($subj_area_id);
			
			if($subject->Insert())
			{			
				$message = $screen_module_name." incluído com sucesso.";
				$subj_id = "";
				$subj_name = "";
				$subj_area_id = "";
			}
			else
			{
				$message = "Problemas na operação.";
			}
		}

		if($action == 3)
		{
			$subject = new Subject();
			$subject->SetDatabase($database);
			$subject->SetId($subj_id);
			$subject->SetName($subj_name);
			$subject->SetArea($subj_area_id);
			
			if($subject->Update())
			{			
				$message = $screen_module_name." alterado com sucesso.";
			}
			else
			{
				$message = "Problemas na operação.";
			}
		}

		if($action == 4)
		{
			$subject = new Subject();
			$subject->SetDatabase($database);
			$subject->SetId($subj_id);
			
			if($subject->Delete())
			{			
				$message = $screen_module_name." excluído com sucesso.";
				$subj_id = "";
				$subj_name = "";
				$subj_area_id = "";
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
				document.form_admin.p_subj_id.value = "";
				document.form_admin.p_subj_name.value = "";
				document.form_admin.p_subj_area_id.value = "";
				document.form_admin.p_action.value="0";
				document.form_admin.submit();
			}
			
			function Query()
			{
				window.open("pgSubjectQuery.php", "querySubject", "width=400,height=200,top=150,left=150,toolbar=0,location=0,status=0,subjectbar=0,scrollbars=0,resizable=0");
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
			<input type="hidden" name="p_subj_id" value="<?php echo $subj_id; ?>">
			<tr>
				<td bgcolor="#EEEEEE" width="100%" valign="top" class="form_title" colspan="2">
				Assuntos
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Nome:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<input type="text" name="p_subj_name" value="<?php echo $subj_name; ?>">
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					&Aacute;rea:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<select name="p_subj_area_id">
						<option value=""></option>

<?php

	$area = new Area();
	$area->SetDatabase($database);
	$result = $area->Select();
	
	while ($data = $database->FetchArray($result))
	{
		$area_id = $data["area_id"];
		$area_name = $data["area_name"];
		
		echo "<option value=\"".$area_id."\">".$area_name."</option>";
	}
	
?>
						
					</select>
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="100%" valign="center" align="center" colspan="2">

<?php

	if($subj_id != "")
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
