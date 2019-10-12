<?php
R::fancyDebug( TRUE );
	$koelnmatchWhere = [];
	
	$koelnmatchWhere[] = " KoelnerPhonetic(".replaceSQL($NUMBERFIELD).",$KOELNCOALESCE) LIKE '%$query%' ";
	$koelnmatchWhere[] = " KoelnerPhonetic($TEXTFIELD1,$KOELNCOALESCE) LIKE '%$query%' ";
	$koelnmatchWhere[] = " KoelnerPhonetic($TEXTFIELD2,$KOELNCOALESCE) LIKE '%$query%' ";
	
	foreach($koeln as $koelnmatch) {
		if (strlen($koelnmatch)<5) continue;
		$koelnmatchWhere[] = "KoelnerPhonetic(".replaceSQL($NUMBERFIELD).",$KOELNCOALESCE) LIKE '%$koelnmatch%' ";
		$koelnmatchWhere[] = "KoelnerPhonetic($TEXTFIELD1,$KOELNCOALESCE) LIKE '%$koelnmatch%' ";
		$koelnmatchWhere[] = "KoelnerPhonetic($TEXTFIELD2,$KOELNCOALESCE) LIKE '%$koelnmatch%' ";
	}
	$querykoelnmatch = R::getAll("
	SELECT  
	$TEXTFIELD1, KoelnerPhonetic($TEXTFIELD1,$KOELNCOALESCE) as kphn1, 
	$TEXTFIELD2, KoelnerPhonetic($TEXTFIELD2,$KOELNCOALESCE) as kphn2,
	$NUMBERFIELD,KoelnerPhonetic(".replaceSQL($NUMBERFIELD).",$KOELNCOALESCE) as kphnr
	FROM $TABLE 
	WHERE $NUMBERFIELD IS NOT NULL AND $NUMBERFIELD <> '' 
	AND (".join(' OR ',$koelnmatchWhere).");
	");
	echo "<pre>";
	echo "<h1>MATCH KoelnPhonektiv with Likes $query </h1>";
	echo join(', ',$koelnqueries),'<br />';
	echo join(', ',$koeln),'<br />';
	echo build_table($querykoelnmatch);
	echo "</pre>";

?>