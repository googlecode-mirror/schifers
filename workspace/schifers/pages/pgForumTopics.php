<?php

	/*
	* pgForumTopics.php
	*
	* This is the forum topics page.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: October 08, 2007
	*/

	$module_name = "forum";

	require '../../schifers/constants/cdConstants.php';
	require '../../'.$WEB_SITE.'src/cdDatabase.php';
	require '../../'.$WEB_SITE.'src/cdDate.php';
	require '../../'.$WEB_SITE.'src/cdUser.php';
	require '../../'.$WEB_SITE.'src/cdSession.php';
	require '../../'.$WEB_SITE.'src/cdGuardian.php';
	require '../../'.$WEB_SITE.'src/cdTopic.php';
	require '../../'.$WEB_SITE.'src/cdMessage.php';
	require '../../'.$WEB_SITE.'src/cdModerator.php';
	require '../../'.$WEB_SITE.'src/cdUserInfo.php';
	
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

<?php				

	if(isset($_GET["p_topc_id"]))
	{
		$p_topc_id = $_GET["p_topc_id"];
	}

	$dad = new Topic();
	$dad->SetDatabase($database);
	$dad->SetId($p_topc_id);
	$dad->SelectById();
	
	$dad->Hit();

	$topic = new Topic();
	$topic->SetDatabase($database);
	$topic->SetTopic($dad->GetTopic());
	$result = $topic->SelectByTopic();

	while($data = $database->FetchArray($result))
	{
	
?>
				
					<tr>
						<td bgcolor="#DDDDDD" width="100%" valign="top" align="left" colspan="5">
							<?php echo $data["topc_title"]; ?>
						</td>
					</tr>
					<tr>
						<td bgcolor="#AAAAAA" width="50%" valign="top" align="center">
							Tópicos
						</td>
						<td bgcolor="#AAAAAA" width="10%" valign="top" align="center">
							Respostas
						</td>
						<td bgcolor="#AAAAAA" width="10%" valign="top" align="center">
							Autor
						</td>
						<td bgcolor="#AAAAAA" width="10%" valign="top" align="center">
							Visualizações
						</td>
						<td bgcolor="#AAAAAA" width="20%" valign="top" align="center">
							Última Mensagem
						</td>
					</tr>

<?php

		$children = new Topic();
		$children->SetDatabase($database);
		$children->SetTopic($data["topc_id"]);
		$result0 = $children->SelectByTopic();

		while($data0 = $database->FetchArray($result0))
		{

			$users_info = new UserInfo();
			$users_info->SetDatabase($database);
			$users_info->SetUser($data0["topc_user_id"]);
			$users_info->SelectByUser();
			
			$messages = new Message();
			$messages->SetDatabase($database);
			$messages->SetTopic($data0["topc_id"]);
			
			$p_topic = new Topic();
			$p_topic->SetDatabase($database);
			$p_topic->SetId($data0["topc_id"]);
			$p_topic->SelectById();
			
?>

					<tr>
						<td bgcolor="#FFFFFF" width="50%" valign="top" align="left">
							<a href="/pages/pgForumMessages.php?p_topc_id=<?php echo $data0["topc_id"]; ?>"><?php echo $data0["topc_title"]; ?></a><br>
						</td>
						<td bgcolor="#FFFFFF" width="10%" valign="middle" align="center">
							<?php echo $messages->CountByTopic(); ?>
						</td>
						<td bgcolor="#FFFFFF" width="10%" valign="middle" align="center">
							<?php echo $users_info->GetNick(); ?>
						</td>
						<td bgcolor="#FFFFFF" width="10%" valign="middle" align="center">
							<?php echo $p_topic->GetHits(); ?>
						</td>
						<td bgcolor="#FFFFFF" width="20%" valign="middle" align="center">

<?php

			$last_message = new Message();
			$last_message->SetDatabase($database);
			$last_message->SetTopic($data0["topc_id"]);
			if ($last_message->SelectLastMessageByTopic())
			{
				$date = new Date();
				$date->SetDate($last_message->GetDate());
				$date->ConvertToFullDisplay();

?>

							<?php echo $date->GetConverted(); ?>, <?php echo $last_message->GetUser(); ?>

<?php

			}

?>						
						
						</td>
					</tr>
					
<?php

		}
	}

?>					
					
				</table>
			</td>
		</tr>
	</table>

<?php

	require '../../'.$WEB_SITE.'blocks/blBottom.php';

?>
	
	</body>
</html>
