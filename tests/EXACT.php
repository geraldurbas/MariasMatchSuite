<?php
	$queryweb = R::getAll( "
	$selectFields
	FROM `$TABLE`
	WHERE $NUMBERFIELD IS NOT NULL AND $NUMBERFIELD <> '' 
	AND (
	$NUMBERFIELD = '$query' OR 
	$TEXTFIELD1 = '$query' OR 
	$TEXTFIELD2 = '$query'
	)
	");
	echo "<pre>";
	echo "<h1>Exakte Suche $query </h1>";
	echo build_table($queryweb);
	echo "</pre>";
?>