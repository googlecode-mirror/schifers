<?php

	if($guardian->GetProfileId() == $ADMIN_PROFILE)
	{
	

?>

		<table width="100%" border="0" cellspacing="0">
			<tr>
				<td bgcolor="#DDDDDD" width="100%" valign="top" align="center">
					<font face="Verdana" color="#000000">
<?php

					$members = $database->GetNumMembers();
					$active_guests = $database->GetNumActiveGuests();
					$active_members = $database->GetNumActiveMembers();
					
					echo "Total de membros: ".$members." - ";

					if($active_members > 1)
					{
						echo "Existem $active_members membros autenticados e ";
					} else if($active_members == 0) {
						echo "Não existem membros autenticados e ";
					} else {
						echo "Existe $active_members membro autenticado e ";
					}

					if($active_guests > 1)
					{
						echo "$active_guests visitantes não autenticados.";
					} else if($active_guests == 0) {
						echo "nenhum visitante.";
					} else {
						echo "$active_guests visitante não autenticado.";
					}
?>

					</font>
				</td>
			</tr>
		</table>

<?php

	}
	else
	{
	
?>

		<table width="100%" cellspacing="1" bgcolor="#000080">
			<tr>
				<td bgcolor="#DDDDDD" width="100%" valign="top" align="center">
					<font face="Verdana" color="#000000">
					Projetado e desenvolvido por Bruno Schifer Bernardi - 2008
					</font>
				</td>
			</tr>
		</table>

<?php

	}

?>