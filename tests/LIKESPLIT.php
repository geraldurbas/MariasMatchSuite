<?php
	if (strripos($query,' ')) {
		$multiLike = [];
		$splitted = explode(' ',$query);
		$multiLike[] = " $NUMBERFIELD LIKE '%$query%' ";
		$multiLike[] = " $TEXTFIELD1 LIKE '%$query%' ";
		$multiLike[] = " $TEXTFIELD2 LIKE '%$query%' ";
		foreach($splitted as $w) {
			if ($w=='') continue;
			$multiLike[] = " $NUMBERFIELD LIKE '%$w%' ";
			$multiLike[] = " $TEXTFIELD1 LIKE '%$w%' ";
			$multiLike[] = " $TEXTFIELD2 LIKE '%$w%' ";
		}

		$queryweb = R::getAll( "
		$selectFields
		FROM `$TABLE`
		WHERE $NUMBERFIELD IS NOT NULL AND $NUMBERFIELD <> '' 
		AND (
		".join(' OR ',$multiLike)."
		)
		");
		echo "<pre>";
		echo "<h1>Like Suche mit zus. Split bei Leerzeichen $query </h1>";
		echo join(', ',$splitted),'<br />';
		echo markSubQuery(build_table($queryweb));
		echo "</pre>";
	} else {
		echo "<h1 style=\"color:#f00;\">KEINE Like Suche mit zus. Split bei Leerzeichen $query </h1>";
	}
?>