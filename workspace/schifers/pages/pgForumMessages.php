<?php

	/*
	* pgForum.php
	*
	* This is the forum page.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: October 01, 2007
	*/

	$module_name = "forum";

	require '../../schifers/constants/cdConstants.php';
	require '../../'.$WEB_SITE.'src/cdDatabase.php';
	require '../../'.$WEB_SITE.'src/cdDate.php';
	require '../../'.$WEB_SITE.'src/cdUser.php';
	require '../../'.$WEB_SITE.'src/cdSession.php';
	require '../../'.$WEB_SITE.'src/cdGuardian.php';
	require '../../'.$WEB_SITE.'src/cdTopic.php';

	if(isset($_GET["p_topc_id"]))
	{
		$p_topc_id = $_GET["p_topc_id"];
	}

	$p_topic = new Topic();
	$p_topic->SetDatabase($database);
	$p_topic->SetId($p_topc_id);
	$p_topic->SelectById();
	
	$p_topic->Hit();
	
?>

<html>
	<head>
		<title>Schifer's</title>
		<link rel="stylesheet" type="text/css" href="/schifers/css/schifers.css">
	</head>
	<body bgcolor="#FFFFFF">

<?php

	require '../../'.$WEB_SITE.'blocks/blTitle.php';

?>

	<table width="100%" cellspacing="1" border="0" bgcolor="#FFFFFF">
		<tr>
			<td bgcolor="#FFFFFF" width="100%" valign="top" align="center">
				<table width="100%" cellspacing="1" border="0" bgcolor="#000080">
					<tr>
						<td bgcolor="#DDDDDD" width="100%" valign="top" align="left" colspan="5">
							<?php echo $p_topic->GetTitle(); ?>
						</td>
					</tr>

<?php

	$messages = new Message();
	$messages->SetDatabase($database);
	$messages->SetTopic($p_topc_id);

?>

					<tr>
						<td bgcolor="#AAAAAA" width="20%" valign="top" align="center">
							Autor
						</td>
						<td bgcolor="#AAAAAA" width="80%" valign="top" align="center">
							Mensagem
						</td>
					</tr>
					<tr>
						<td bgcolor="#FFFFFF" width="20%" valign="top" align="left">
							Bruno<br>
							Administrador<br><br>
							Regisrado em 20/10/2007<br>
							Mensagens: 10<br><br>
						</td>
						<td bgcolor="#FFFFFF" width="80%" valign="top" align="left" class="forum_message">
							Enviada em 21/10/2007 05:00:00, Título: O poder do jogo<br><br>
							Eu estou com uma dúvida a respeito da programação do jogo.<br>
							Não sei por onde começar, se alguém puder me ajudar,<br>
							Eu agradeceria.<br><br>
							Obrigado.<br><br>
						</td>
					</tr>
					<tr>
						<td bgcolor="#FFFFFF" width="20%" valign="top" align="left">
							Bruno<br>
							Administrador<br><br>
							Regisrado em 20/10/2007<br>
							Mensagens: 10<br><br>
						</td>
						<td bgcolor="#FFFFFF" width="80%" valign="top" align="left" class="forum_message">
							Enviada em 21/10/2007 05:00:00, Título: O poder do jogo<br><br>
							Eu estou com uma dúvida a respeito da programação do jogo.<br>
							Não sei por onde começar, se alguém puder me ajudar,<br>
							Eu agradeceria.<br><br>
							Obrigado.<br><br>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>

<?php

	require '../../'.$WEB_SITE.'blocks/blBottom.php';

?>
	
	</body>
</html>
