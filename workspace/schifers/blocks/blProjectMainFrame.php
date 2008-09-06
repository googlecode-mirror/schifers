<?php

	/*
	* blMainFrame.php
	*
	* The main frame block for the main page of the web site.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: July 30, 2007
	*/
	
?>

		<script language="Javascript">
		
			function ChangePage(page)
			{
				document.form_admin.p_arti_id.value = "<?php echo $arti_id; ?>";
				document.form_admin.p_page_id.value = page;
				document.form_admin.submit();
			}
		
		</script>

		<table width="100%" cellspacing="0" bgcolor="#000080">
			<tr>
				<td bgcolor="#FFFFFF">

<?php
	if($arti_id == "")
	{
		$article_last = new Article();
		$article_last->SetDatabase($database);
		$article_last->SelectLastArticleByUserAndMenuName($guardian->GetUserId(), "Projetos");
		
		$arti_id = $article_last->GetId();
	}

	if($arti_id != "")
	{

		$article_tmp = new Article();
		$article_tmp->SetDatabase($database);
		$article_tmp->SetId($arti_id);
		$article_tmp->SelectById();
		
?>				
				
					<table width="100%" cellspacing="1" bgcolor="#000080">
						<tr>
							<td bgcolor="#DDDDDD" align="center" width="100%">

<?php

		echo $article_tmp->GetTitle();
	
?>

							</td>
						</tr>
						<tr>
							<td bgcolor="#FFFFFF" align="right" width="100%">

<?php

		$page = new Page();
		$page->SetDatabase($database);

		if($page_id != "")
		{
			$page->SetId($page_id);
			$page->SelectById();
		}
		else if($arti_id != "")
		{
			$page->SetArticle($arti_id);
			$page->SelectFirstPageByArticle($arti_id);
		}
		
		$page_id = $page->GetId();

		echo "Página: ".$page->GetNumber()."<br>";

?>

							</td>
						</tr>
						<tr>
							<td bgcolor="#FFFFFF" align="left" width="100%"><br>

<?php

		$paragraph = new Paragraph();
		$paragraph->SetDatabase($database);
		$paragraph->SetPage($page_id);
		$result = $paragraph->SelectByPage();
		
		while($data = $database->FetchArray($result))
		{

			echo $data["para_text"];
		
		}

?>			

							</td>
						</tr>
						<tr>
							<td bgcolor="#FFFFFF" align="center" width="100%">

<?php

		$previous = $page->SelectPrevious();
		$next = $page->SelectNext();

		if($previous != 0)
		{
		
?>

								<a href="javascript:ChangePage(<?php echo $previous; ?>);">Anterior</a>&nbsp;

<?php		
		
		}
		if($next != 0)
		{
		
?>

								<a href="javascript:ChangePage(<?php echo $next; ?>);">Próxima</a>&nbsp;

<?php		
		
		}

?>			

								<a href="/index.php">Sair</a>
							</td>
						</tr>
					</table>
					
<?php

	}

?>					
					
				</td>
			</tr>
		</table>
