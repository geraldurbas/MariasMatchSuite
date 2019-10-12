<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'rb.php';
require 'functions.php';

R::setup( 'mysql:host=localhost;dbname=test','root', '' );


$testQueries=[
'Bewegungsmelder','Sicherheitsbedienteil',
'Lichtschranke Dual','Lichtschranke innen',
'Licht schranke innen','innen Lichtschranke',
'D 070288/42','D070288/42','D07028842','D-07028842','D-070288-42',
'F 070288/15 U','F070288/15U','070288','70288/15','F 070288/15 U Außen',
];
$TABLE = 'products';
$NUMBERFIELD = 'productnumber';
$TEXTFIELD1 = 'productname';
$TEXTFIELD2 = 'tradename';

$KOELNCOALESCE = 100;

$TESTS = array(
	'LIKE',
	'EXACT',
	'LIKESPLIT',
	'LIKEEXTSPLIT',
	'NATURALLANGUAGE',
	'BOOLEAN',
	'NATURALLANGUAGEEXPANSION',
	'KOELNERPHONETIC',
	'NUMBERSORT',
	'KOELNSORT',
);

$query = isset($_GET['query'])?$_GET['query']:'';
$replaceQuery = replaceSQL("'".$query."'");
$replaceNumber = replaceSQL($NUMBERFIELD);

$selectFields = "
SELECT

$TEXTFIELD1,
SOUNDEX($TEXTFIELD1) as productsound,
KoelnerPhonetic($TEXTFIELD1,$KOELNCOALESCE) as productkph,

$TEXTFIELD2,
SOUNDEX($TEXTFIELD2) as tradesound,
KoelnerPhonetic($TEXTFIELD2,$KOELNCOALESCE) as tradekph,

$NUMBERFIELD,
SOUNDEX($NUMBERFIELD) as numbersound,
KoelnerPhonetic($NUMBERFIELD,$KOELNCOALESCE) as numberkph,
$replaceNumber
as number_replaced,

SOUNDEX(
$replaceNumber
) as numbersound_replaced,

KoelnerPhonetic(
$replaceNumber
,$KOELNCOALESCE) as numberkph_replaced ";
?>