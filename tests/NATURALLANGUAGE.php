<?php
	$querymatchnatural = R::getAll( "
	$selectFields
	,MATCH ($NUMBERFIELD,$TEXTFIELD1,$TEXTFIELD2)
	AGAINST ('$query' IN NATURAL LANGUAGE MODE) as Score
	FROM `$TABLE`
	WHERE $NUMBERFIELD IS NOT NULL AND $NUMBERFIELD <> '' 
	AND MATCH ($NUMBERFIELD,$TEXTFIELD1,$TEXTFIELD2)
	AGAINST ('$query' IN NATURAL LANGUAGE MODE);
	");
	echo "<pre>";
	echo "<h1>MATCH IN NATURAL LANGUAGE MODE Suche $query </h1>";
	echo build_table($querymatchnatural);
	echo "</pre>";
?>