<?php

	/*
	* pgProfile.php
	*
	* Profile.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: August 04, 2007
	*/
	
	$module_name = "profile";

	require '../../schifers/constants/cdConstants.php';
	require '../../'.$WEB_SITE.'src/cdDatabase.php';
	require '../../'.$WEB_SITE.'src/cdDate.php';
	require '../../'.$WEB_SITE.'src/cdProfile.php';
	require '../../'.$WEB_SITE.'src/cdUser.php';
	require '../../'.$WEB_SITE.'src/cdSession.php';
	require '../../'.$WEB_SITE.'src/cdGuardian.php';

	$screen_module_name = "Perfil";

	if(isset($_POST["p_action"]))
	{
		$action = $_POST["p_action"];
		$prof_id = $_POST["p_prof_id"];
		$prof_name = $_POST["p_prof_name"];
		$message = "";

		if($action == 1)
		{
			$profile = new Profile();
			$profile->SetDatabase($database);
			$profile->SetId($prof_id);
			$profile->SelectById();
			
			$prof_id = $profile->GetId();
			$prof_name = $profile->GetName();
			
			if($prof_id == "")
			{
				$message = $screen_module_name." n�o encontrado.";
				$prof_id = "";
				$prof_name = "";
			}
		}
		
		if($action == 2)
		{
			$profile = new Profile();
			$profile->SetDatabase($database);
			$profile->SetName($prof_name);
			
			if($profile->Insert())
			{			
				$message = $screen_module_name." inclu�do com sucesso.";
				$prof_id = "";
				$prof_name = "";
			}
			else
			{
				$message = "Problemas na opera��o.";
			}
		}

		if($action == 3)
		{
			$profile = new Profile();
			$profile->SetDatabase($database);
			$profile->SetId($prof_id);
			$profile->SetName($prof_name);
			
			if($profile->Update())
			{			
				$message = $screen_module_name." alterado com sucesso.";
			}
			else
			{
				$message = "Problemas na opera��o.";
			}
		}

		if($action == 4)
		{
			$profile = new Profile();
			$profile->SetDatabase($database);
			$profile->SetId($prof_id);
			
			if($profile->Delete())
			{			
				$message = $screen_module_name." exclu�do com sucesso.";
				$prof_id = "";
				$prof_name = "";
			}
			else
			{
				$message = "Problemas na opera��o.";
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
				document.form_admin.p_prof_id.value = "";
				document.form_admin.p_prof_name.value = "";
				document.form_admin.p_action.value="0";
				document.form_admin.submit();
			}
			
			function Query()
			{
				window.open("pgProfileQuery.php", "queryProfile", "width=600,height=500,top=150,left=150,toolbar=0,location=0,status=0,menubar=0,scrollbars=1,resizable=1");
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
			<input type="hidden" name="p_prof_id" value="<?php echo $prof_id; ?>">
			<tr>
				<td bgcolor="#EEEEEE" width="100%" valign="top" class="form_title" colspan="2">
				Perfis
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Nome:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<input type="text" name="p_prof_name" value="<?php echo $prof_name; ?>">
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="100%" valign="center" align="center" colspan="2">

<?php

	if($prof_id != "")
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
