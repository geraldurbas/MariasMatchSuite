<?php
	$result = R::getAll( "
	$selectFields
	FROM `$TABLE`
	WHERE $NUMBERFIELD IS NOT NULL AND $NUMBERFIELD <> ''
	ORDER BY numberkph_replaced
	" );
	echo "<pre>";
	echo "<h1>Komplette Liste sortiert nach  KÖLN</h1>";
	echo build_table($result);
	echo "</pre>";
?>