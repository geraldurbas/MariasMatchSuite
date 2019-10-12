<?php
	$querymatchbool = R::getAll( "
	$selectFields
	,MATCH ($NUMBERFIELD,$TEXTFIELD1,$TEXTFIELD2)
	AGAINST ('$query' IN BOOLEAN MODE) as Score
	FROM `$TABLE`
	WHERE $NUMBERFIELD IS NOT NULL AND $NUMBERFIELD <> '' 
	AND MATCH ($NUMBERFIELD,$TEXTFIELD1,$TEXTFIELD2)
	AGAINST ('$query' IN BOOLEAN MODE);
	");
	echo "<pre>";
	echo "<h1>MATCH IN BOOLEAN MODE Suche $query </h1>";
	echo build_table($querymatchbool);
	echo "</pre>";
?>