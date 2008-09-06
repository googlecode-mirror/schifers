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
	require '../../'.$WEB_SITE.'src/cdMessage.php';
	require '../../'.$WEB_SITE.'src/cdModerator.php';
	
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
						<td bgcolor="#AAAAAA" width="60%" valign="top" align="center">
							Fórum
						</td>
						<td bgcolor="#AAAAAA" width="10%" valign="top" align="center">
							Tópicos
						</td>
						<td bgcolor="#AAAAAA" width="10%" valign="top" align="center">
							Mensagens
						</td>
						<td bgcolor="#AAAAAA" width="20%" valign="top" align="center">
							Última Mensagem
						</td>
					</tr>

<?php

	$areas = new Topic();
	$areas->SetDatabase($database);
	$areas->SetLevel(1);
	$result0 = $areas->SelectByLevel();
	
	while($data0 = $database->FetchArray($result0))
	{

?>

					<tr>
						<td bgcolor="#DDDDDD" width="100%" valign="top" align="left" colspan="4">
							<?php echo $data0["topc_title"]; ?>
						</td>
					</tr>

<?php

		$forums = new Topic();
		$forums->SetDatabase($database);
		$forums->SetTopic($data0["topc_id"]);
		$result1 = $forums->SelectByTopic();
		
		while($data1 = $database->FetchArray($result1))
		{

?>

					<tr>
						<td bgcolor="#FFFFFF" width="60%" valign="top" align="left">
							<a href="/pages/pgForumTopics.php?p_topc_id=<?php echo $data1["topc_id"]; ?>"><?php echo $data1["topc_title"]; ?></a> - <?php echo $data1["topc_text"]; ?><br>
							Moderadores: 

<?php

			$moderator = new Moderator();
			$moderator->SetDatabase($database);
			$moderator->SetTopic($data1["topc_id"]);
			$result2 = $moderator->SelectByTopic();
			
			$html = "";
			
			while($data2 = $database->FetchArray($result2))
			{

				$html = $html.$data2["usif_nick"].", ";

			}
			
			echo substr($html, 0, strlen($html) - 2);

?>							
							
						</td>
						<td bgcolor="#FFFFFF" width="10%" valign="middle" align="center">

<?php

			$forums->SetTopic($data1["topc_id"]);
			echo $forums->CountByTopic();

?>
							
						</td>
						<td bgcolor="#FFFFFF" width="10%" valign="middle" align="center">

<?php

			$messages = new Message();
			$messages->SetDatabase($database);
			$messages->SetTopic($data1["topc_id"]);
			echo $messages->CountByTopic();
			
?>
							
						</td>
						<td bgcolor="#FFFFFF" width="20%" valign="middle" align="center">
<?php

			$last_message = new Message();
			$last_message->SetDatabase($database);
			$last_message->SetTopic($data1["topc_id"]);
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
