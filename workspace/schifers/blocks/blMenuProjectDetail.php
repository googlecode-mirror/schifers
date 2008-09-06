<?php

	/*
	* blMenuArticle.php
	*
	* The menu article block for the web site.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: September 24, 2007
	*/

	/* Dependencies
	*
	*/
	
?>

		<table width="100%" cellspacing="1" bgcolor="#000080">

		<script language="Javascript">
		
			function ChangeArticle(article)
			{
				document.form_admin.p_arti_id.value = article;
				document.form_admin.p_page_id.value = "";
				document.form_admin.submit();
			}
		
		</script>
		
<?php

	$arti_menu_id = "";

	$project_name = $module_name;
	
	$area = new Area();
	$area->SetDatabase($database);
	$area->SetName($project_name);
	$area->SelectByName();
	
	$subject = new Subject();
	$subject->SetDatabase($database);
	$subject->SetArea($area->GetId());
	$result = $subject->SelectByArea();

	$counter = 0;

	while($data = $database->FetchArray($result))
	{
	
?>

			<tr>
				<td bgcolor="#DDDDDD" align="center" width="100%">

<?php

	echo $data["subj_name"];
	
?>

				</td>
			</tr>

<?php

		$article = new Article();
		$article->SetDatabase($database);
		$article->SetSubject($data["subj_id"]);

		$result1 = $article->SelectBySubject();
		
		while($data1 = $database->FetchArray($result1))
		{
		
?>

			<tr>
				<td bgcolor="#FFFFFF" align="center" width="100%">

<?php

					echo "<a href=\"javascript: ChangeArticle(".$data1["arti_id"].");\">".$data1["arti_title"]."</a>";

?>			
				
				</td>
			</tr>
		
<?php		

			$counter++;

		}

	}

?>

		</table>
