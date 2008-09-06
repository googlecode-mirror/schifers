<?php

	/*
	* pgModule.php
	*
	* Module.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: August 04, 2007
	*/
	
	$module_name = "module";

	require '../../schifers/constants/cdConstants.php';
	require '../../'.$WEB_SITE.'src/cdDatabase.php';
	require '../../'.$WEB_SITE.'src/cdDate.php';
	require '../../'.$WEB_SITE.'src/cdModule.php';
	require '../../'.$WEB_SITE.'src/cdUser.php';
	require '../../'.$WEB_SITE.'src/cdSession.php';
	require '../../'.$WEB_SITE.'src/cdGuardian.php';
	
?>

<?php

	$screen_module_name = "Módulo";

	if(isset($_POST["p_action"]))
	{
		$action = $_POST["p_action"];
		$modu_id = $_POST["p_modu_id"];
		$modu_nick = $_POST["p_modu_nick"];
		$modu_name = $_POST["p_modu_name"];
		$modu_url = $_POST["p_modu_url"];
		$message = "";

		if($action == 1)
		{
			$modu = new Module();
			$modu->SetDatabase($database);
			$modu->SetId($modu_id);
			$modu->SelectById();
			
			$modu_id = $modu->GetId();
			$modu_name = $modu->GetName();
			$modu_nick = $modu->GetNick();
			$modu_url = $modu->GetUrl();
			
			if($modu_id == "")
			{
				$message = $screen_module_name." não encontrado.";
				$modu_id = "";
				$modu_nick = "";
				$modu_name = "";
				$modu_url = "";
			}
		}
		
		if($action == 2)
		{
			$modu = new Module();
			$modu->SetDatabase($database);
			$modu->SetNick($modu_nick);
			$modu->SetName($modu_name);
			$modu->SetUrl($modu_url);
			
			if($modu->Insert())
			{			
				$message = $screen_module_name." incluído com sucesso.";
				$modu_id = "";
				$modu_nick = "";
				$modu_name = "";
				$modu_url = "";
			}
			else
			{
				$message = "Problemas na operação.";
			}
		}

		if($action == 3)
		{
			$modu = new Module();
			$modu->SetDatabase($database);
			$modu->SetId($modu_id);
			$modu->SetNick($modu_nick);
			$modu->SetName($modu_name);
			$modu->SetUrl($modu_url);
			
			if($modu->Update())
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
			$modu = new Module();
			$modu->SetDatabase($database);
			$modu->SetId($modu_id);
			
			if($modu->Delete())
			{			
				$message = $screen_module_name." excluído com sucesso.";
				$modu_id = "";
				$modu_nick = "";
				$modu_name = "";
				$modu_url = "";
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
				document.form_admin.p_modu_id.value = "";
				document.form_admin.p_modu_nick.value = "";
				document.form_admin.p_modu_name.value = "";
				document.form_admin.p_modu_url.value = "";
				document.form_admin.p_action.value="0";
				document.form_admin.submit();
			}
			
			function Query()
			{
				window.open("pgModuleQuery.php", "queryModule", "width=600,height=500,top=150,left=150,toolbar=0,location=0,status=0,menubar=0,scrollbars=1,resizable=1");
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
			<input type="hidden" name="p_modu_id" value="<?php echo $modu_id; ?>">
			<tr>
				<td bgcolor="#EEEEEE" width="100%" valign="top" class="form_title" colspan="2">
				Módulos
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Sigla:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<input type="text" name="p_modu_nick" value="<?php echo $modu_nick; ?>">
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Nome:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<input type="text" name="p_modu_name" value="<?php echo $modu_name; ?>">
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Url:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<input type="text" name="p_modu_url" value="<?php echo $modu_url; ?>">
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="100%" valign="center" align="center" colspan="2">

<?php

	if($modu_id != "")
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
