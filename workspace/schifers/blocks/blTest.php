<?php

	if(isset($_GET["passo"]))
	{
		$passo = $_GET["passo"];
		echo $passo;
		
		if($passo == 0)
		{
			for($i = 0; $i < 50; $i++)
			{

?>

	<script language="Javascript">
		window.parent.document.all.td_progress<?php echo $i; ?>.style.backgroundColor = "#FFFFFF";
	</script>

<?php

			}

?>

	<script language="Javascript">
		window.location = "blTest.php?passo=1";
	</script>

<?php

		}

		for($i = 0; $i < 50; $i++)
		{
			if($passo == $i)
			{
				for($k = 0; $k < $i; $k++)
				{

?>

	<script language="Javascript">
		window.parent.document.all.td_progress<?php echo $k; ?>.style.backgroundColor = "#000000";
	</script>
	
<?php
	
				}
?>

	<script language="Javascript">
		window.location = "blTest.php?passo=<?php $j = $i + 1; echo $j; ?>";
	</script>

<?php
		
			}
		
		
		}
		
	}

	if($passo == 50)
	{
	
?>

	<script language="Javascript">
		window.parent.document.all.td_progress49.style.backgroundColor = "#000000";
	</script>

<?php

	}

?>