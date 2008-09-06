<?php

	/*
	* doQueryOrder.php
	*
	* Query order for paragraphs page.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: September 27, 2007
	*/

?>

<?php

	require '../constants/cdConstants.php';
	require '../src/cdDatabase.php';
	require '../src/cdParagraph.php';

?>

<?php

	$page_id = $_GET["p_para_page_id"];
	
	$paragraph = new Paragraph();
	$paragraph->SetDatabase($database);
	$paragraph->SetPage($page_id);
	$next_order = $paragraph->SelectNextOrder();

?>

<script language="Javascript">

	parent.document.form_admin.p_para_order.value = "<?php echo $next_order; ?>";

</script>