<?php
	$queryweb = R::getAll( "
	$selectFields
	FROM `$TABLE`
	WHERE $NUMBERFIELD IS NOT NULL AND $NUMBERFIELD <> '' 
	AND (
	$NUMBERFIELD LIKE '%$query%' OR 
	$TEXTFIELD1 LIKE '%$query%' OR 
	$TEXTFIELD2 LIKE '%$query%'
	)
	");
	echo "<pre>";
	echo "<h1>Aktuelle Suche $query </h1>";
	echo build_table($queryweb);
	echo "</pre>";
?>