<?php
include('include/config.php');
if (!checkAjax()) include('include/head.php');



$koelnqueries = [];
$koeln = [];

if (!checkAjax()) {
?>
<form>
<input name="query" type="text" value="<?=$query?>"/>
<input type="submit"/>
<form>
<br />Testsuchen: 
<?php
array_walk($testQueries,function(&$item,$key) {echo '<a href="./?query='.$item.'">'.$item.'</a> | ';});
?>
<hr />
<?php






	 #R::fancyDebug( TRUE );

	$querykey = R::getAll( "
	SELECT 
	'$query' as query,
	SOUNDEX('$query') as soundex,
	KoelnerPhonetic('$query',$KOELNCOALESCE) as kph,
	$replaceQuery as replaced,
	SOUNDEX($replaceQuery) as sound_replaced,
	KoelnerPhonetic($replaceQuery,$KOELNCOALESCE) as kph_replaced
	");
	echo "<pre>";
	echo "<h1>Keys der Suche $query </h1>";
	echo build_table($querykey,'querykeys');
	echo 'zeige: <span class="tgl">'.$query.'</span> | <span id="tgl">'.$query.'</span> | ';
	echo '<span class="showall">alle anzeigen</span>';
	echo "</pre>";

	$koelnqueries[] = $query;
	$koeln[] = $querykey[0]['kph_replaced'];

	if (strripos($query,' ') || strripos($query,'|') || strripos($query,'/') || strripos($query,'\\') || strripos($query,'_') || strripos($query,'-')) {
		$multiLike = ' ';
		$splitted = preg_split('/[\s]|[\|]|[\/]|[\\]|[_]|[-]/',$query);
		foreach($splitted as $w) {
			if ($w=='') continue;
			$replaceQueryWord = replaceSQL("'".$w."'");;
			
			$querykey = R::getAll( "
			SELECT 
			'$w' as word,
			SOUNDEX('$w') as soundex,
			KoelnerPhonetic('$w',$KOELNCOALESCE) as kph,
			$replaceQueryWord as replaced,
			SOUNDEX($replaceQueryWord) as sound_replaced,
			KoelnerPhonetic($replaceQueryWord,$KOELNCOALESCE) as kph_replaced
			");
			echo '<pre style="float:left;">';
			echo "<h1>Keys der Suche $w </h1>";
			echo build_table($querykey,'querywords');
			echo 'zeige: <span class="wordtgl">'.$w.' (aus '.$query.')</span> | ';
			echo '<span class="showall">alle anzeigen</span>';
			echo "</pre>";
			$koelnqueries[] = $w;
			$koeln[] = $querykey[0]['kph_replaced'];
		}
	} else {
		echo "<h1 style=\"color:#f00;\">Keys der Suche mit Split bei Sonderzeichen (return, |, /, \\, _, -) $query </h1>";
	}



	echo '<hr style="clear:both;">';
	$_SESSION['koelnqueries'] = $koelnqueries;
	$_SESSION['koeln'] = $koeln;
	$_SESSION['query'] = $query;
} else {
	$koelnqueries = $_SESSION['koelnqueries'];
	$koeln = $_SESSION['koeln'];
	$query = $_SESSION['query'];
	
	#R::fancyDebug( TRUE );
}


if (isset($_POST['loadtest']) && in_array($_POST['loadtest'],$TESTS)) {
	include('tests/'.$_POST['loadtest'].'.php');
}

?>
<?php
if (!checkAjax()) include('include/footer.php');
?>