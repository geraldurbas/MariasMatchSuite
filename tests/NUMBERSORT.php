<?php
	$result = R::getAll( "
	$selectFields
	FROM `$TABLE`
	WHERE $NUMBERFIELD IS NOT NULL AND $NUMBERFIELD <> ''
	ORDER BY $NUMBERFIELD
	" );
	echo "<pre>";
	echo "<h1>Komplette Liste sortiert nach  $NUMBERFIELD</h1>";
	echo build_table($result);
	echo "</pre>";
?>