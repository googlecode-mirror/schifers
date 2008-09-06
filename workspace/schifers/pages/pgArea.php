<?php

	/*
	* pgArea.php
	*
	* Area.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: August 04, 2007
	*/
	
	$module_name = "area";

	require '../../schifers/constants/cdConstants.php';
	require '../../'.$WEB_SITE.'src/cdDatabase.php';
	require '../../'.$WEB_SITE.'src/cdDate.php';
	require '../../'.$WEB_SITE.'src/cdArea.php';
	require '../../'.$WEB_SITE.'src/cdUser.php';
	require '../../'.$WEB_SITE.'src/cdSession.php';
	require '../../'.$WEB_SITE.'src/cdGuardian.php';

	$screen_module_name = "&Aacute;rea";

	if(isset($_POST["p_action"]))
	{
		$action = $_POST["p_action"];
		$area_id = $_POST["p_area_id"];
		$area_name = $_POST["p_area_name"];
		$message = "";

		if($action == 1)
		{
			$area = new Area();
			$area->SetDatabase($database);
			$area->SetId($area_id);
			$area->SelectById();
			
			$area_id = $area->GetId();
			$area_name = $area->GetName();
			
			if($area_id == "")
			{
				$message = $screen_module_name." não encontrada.";
				$area_id = "";
				$area_name = "";
			}
		}
		
		if($action == 2)
		{
			$area = new Area();
			$area->SetDatabase($database);
			$area->SetName($area_name);
			
			if($area->Insert())
			{			
				$message = $screen_module_name." incluída com sucesso.";
				$area_id = "";
				$area_name = "";
			}
			else
			{
				$message = "Problemas na operação.";
			}
		}

		if($action == 3)
		{
			$area = new Area();
			$area->SetDatabase($database);
			$area->SetId($area_id);
			$area->SetName($area_name);
			
			if($area->Update())
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
			$area = new Area();
			$area->SetDatabase($database);
			$area->SetId($area_id);
			
			if($area->Delete())
			{			
				$message = $screen_module_name." excluída com sucesso.";
				$area_id = "";
				$area_name = "";
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
				document.form_admin.p_area_id.value = "";
				document.form_admin.p_area_name.value = "";
				document.form_admin.p_action.value="0";
				document.form_admin.submit();
			}
			
			function Query()
			{
				window.open("pgAreaQuery.php", "queryArea", "width=600,height=500,top=150,left=150,toolbar=0,location=0,status=0,areabar=0,scrollbars=1,resizable=1");
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
			<input type="hidden" name="p_area_id" value="<?php echo $area_id; ?>">
			<tr>
				<td bgcolor="#EEEEEE" width="100%" valign="top" class="form_title" colspan="2">
				&Aacute;reas
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Nome:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<input type="text" name="p_area_name" value="<?php echo $area_name; ?>">
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="100%" valign="center" align="center" colspan="2">

<?php

	if($area_id != "")
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
