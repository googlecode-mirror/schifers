<?php

	/*
	* blNews.php
	*
	* The news block for the web site.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: July 31, 2007
	*/

	/* Dependencies
	*
	* require src/cdNew.php
	*
	*/
	
	$first_new_id = 0;
	$last_new_id = 0;
	
	if(isset($_POST["p_first_new_id"]))
	{
		$first_new_id = $_POST["p_first_new_id"];
	}
	if(isset($_POST["p_last_new_id"]))
	{
		$last_new_id = $_POST["p_last_new_id"];
	}

	$news = new News();
	$news->SetDatabase($database);
	
?>

			<script language="Javascript">
				
				function ChangePageBack(first_new_id)
				{
					document.form_news.p_first_new_id.value = first_new_id;
					document.form_news.submit();
				}
				
				function ChangePageForward(last_new_id)
				{
					document.form_news.p_last_new_id.value = last_new_id;
					document.form_news.submit();
				}
				
			</script>

			<form name="form_news" method="post">
				<input type="hidden" name="p_first_new_id" value="">
				<input type="hidden" name="p_last_new_id" value="">
				<table width="100%" cellspacing="1" bgcolor="#000080">

<?php

	$news_per_page = 5;
	
	if($first_new_id != 0)
	{
		$result = $news->SelectNextPage($first_new_id);
	}
	else if($last_new_id != 0)
	{
		$result = $news->SelectNextPage($last_new_id);
	}
	else
	{
		$result = $news->Select();
	}
	
	$counter = 0;
	
	while($data = $database->FetchArray($result))
	{
		if($counter == 0)
		{
			$first_new_id = $data["news_id"];
		}

		if($counter >= $news_per_page)
		{
			break;
		}

		$last_new_id = $data["news_id"];
		
		$date = new Date();
		$date->SetDate($data["news_date"]);
		$date->ConvertToFullDisplay();

?>
	
					<tr>
						<td bgcolor="#DDDDDD" align="left" width="20%">
							<?php echo $date->GetConverted(); ?>
						</td>
						<td bgcolor="#DDDDDD" align="left" width="80%">
							<?php echo $data["news_title"]; ?>
						</td>
					</tr>
					<tr>
						<td bgcolor="#FFFFFF" align="left" width="100%" colspan="2">
							<?php echo $data["news_text"]; ?>
						</td>
					</tr>

<?php

		$counter++;
	}

?>	
	
					<tr>
			
<?php			
			
	$result1 = $news->SelectPreviousPage(&$first_new_id, $news_per_page);
	$result2 = $news->SelectNextPage(&$last_new_id);
	
	$count1 = mysql_num_rows($result1);
	$count2 = mysql_num_rows($result2);
	
	if($count1 > 0)
	{
	
?>

						<td bgcolor="#FFFFFF" align="center" colspan="2">
							<a href="javascript:ChangePageBack(<?php echo $first_new_id; ?>);">Anterior</a>
							&nbsp;

<?php	
	
	}
	else
	{

?>

						<td bgcolor="#FFFFFF" align="center" colspan="2">

<?php	

	}

	if($count1 == 0 && $count2 == 0)
	{

?>

							&nbsp;

<?php

	}
	
	if($count2 > 0)
	{
	
?>

							<a href="javascript:ChangePageForward(<?php echo $last_new_id; ?>);">Próxima</a>
						</td>

<?php	

	}
	else
	{

?>

						</td>

<?php	

	}
	
?>

					</tr>
				</table>
			</form>
			