<?php

	/*
	* doQueryNumber.php
	*
	* Query number for page's article.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: September 28, 2007
	*/

?>

<?php

	require '../constants/cdConstants.php';
	require '../src/cdDatabase.php';
	require '../src/cdPage.php';

?>

<?php

	$arti_id = $_GET["p_page_arti_id"];
	
	$page = new Page();
	$page->SetDatabase($database);
	$page->SetArticle($arti_id);
	$next_number = $page->SelectNextNumber();

?>

<script language="Javascript">

	parent.document.form_admin.p_page_number.value = "<?php echo $next_number; ?>";

</script>