<?php

	/*
	* blMenuAdministration.php
	*
	* The menu administration block for the web site.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: July 31, 2007
	*/

?>

		<table width="100%" cellspacing="1" bgcolor="#000080">
			<tr>
				<td bgcolor="#DDDDDD" align="center" width="100%">

<?php

	$menu_builder = new MenuBuilder();
	$menu_builder->SetDatabase($database);
	$menu_builder->SetName("Administração");
	$screen_name = $menu_builder->GetScreenName();
	echo $screen_name;
	
?>

				</td>
			</tr>

<?php

	$result = $menu_builder->Build();
	while($data = $database->FetchArray($result))
	{
		echo "<tr>";
		echo "<td bgcolor=\"#FFFFFF\" align=\"center\" width=\"100%\">";
		echo "<a href=\"".$data["modu_url"]."\">".$data["modu_name"]."</a>";
		echo "</td>";
		echo "</tr>";
	}

?>

		</table>
