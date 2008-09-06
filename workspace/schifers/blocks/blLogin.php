<?php

	/*
	* blLogin.php
	*
	* The login block for the web site.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: July 30, 2007
	*/

?>

<?php

	if(isset($_GET["error_message"]))
	{
		$error_message = $_GET["error_message"];
	}

?>

		<script language="Javascript">
			
            function TratarEventoTeclado() {
                if(window.event.keyCode == 13) {
                    document.form_login.submit();
                }
                
                return false;
            }

			function CloseSession()
			{
				document.form_login.p_close_session.value = "1";
				document.form_login.action = "/schifers/actions/doCloseSession.php";
				document.form_login.submit();
			}
			
		</script>

		<form method="post" action="/schifers/actions/doLogin.php" name="form_login">
			<input type="hidden" name="p_session_id" value="<?php echo $guardian->GetId(); ?>">
			<input type="hidden" name="p_close_session">
			<table bgcolor="#000080" cellspacing="1" width="100%">
					<tr>
						<td bgcolor="#DDDDDD" colspan="2" align="center">
							<font face="Verdana">
								Autenticação
							</font>
						</td>
					</tr>
					<tr>
						<td bgcolor="#FFFFFF" width="100%" align="right">
							<font face="Verdana">
								Usuário:&nbsp;
							</font>
						</td>
						<td bgcolor="#FFFFFF">
							<input type="text" name="p_username" class="p1" onKeyDown="TratarEventoTeclado();">
						</td>
					</tr>
					<tr>
						<td bgcolor="#FFFFFF" width="100%" align="right">
							<font face="Verdana">
								Senha:&nbsp;
							</font>
						</td>
						<td bgcolor="#FFFFFF">
							<input type="password" name="p_password" class="p1" onKeyDown="TratarEventoTeclado();">
						</td>
					</tr>
					<tr>
						<td bgcolor="#FFFFFF" colspan="2" align="center">
							<a href="javascript:document.form_login.submit();">Entrar</a>
							&nbsp;
							<a href="javascript:CloseSession();">Sair</a>
						</td>
					</tr>
					<tr>
						<td bgcolor="#FFFFFF" colspan="2" align="center">
							<font color="#FF0000">
		
		<?php
		echo $error_message."&nbsp;";
		?>
		
							</font>
						</td>
					</tr>
			</table>
		</form>
		