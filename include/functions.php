<?php

function checkAjax() {
	return (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
}

function build_table($array,$id=""){
	$query = isset($_GET['query'])?$_GET['query']:'';
	
	if (!sizeof($array)) return '<b style="color:#f00;">nichts zu '.$query.' gefunden</b><br />';
    // start table
	echo '<div>',sizeof($array),' Zeilen gefunden:</div>';
    $html = '<table id="'.$id.'" class="tbl'.$id.'">';
    // header row
    $html .= '<tr>';
    foreach($array[0] as $key=>$value){
            $html .= '<th>' . htmlspecialchars($key) . '</th>';
        }
    $html .= '<th>Zeile</th></tr>';

    // data rows
	$i = 1;
    foreach( $array as $key=>$value){
        $html .= '<tr>';
        foreach($value as $key2=>$value2){
			$td = str_replace($query,'<b style="color:#0000AAAA;">'.$query.'</b>',htmlspecialchars($value2));
            $html .= '<td>' . $td . '</td>';
        }
        $html .= '<td>'.$i.'</td></tr>';
		$i++;
    }

    // finish table and return it

    $html .= '</table>';
    return $html;
}

function markSubQuery($html) {
	$query = isset($_GET['query'])?$_GET['query']:'';
	
	$splitted = [];
	if (strripos($query,' ')) {
		$splitted = explode(' ',$query);
	}
	if (sizeof($splitted)) {
		$i=1;
		foreach($splitted as $w) {
			$html = str_replace($w,'<i style="background-color:#00AAAAFF;">'.$w.'('.$i.')</i>',$html);
			$i++;
		}
	}
	return $html;
}

function replaceSQL($query) {
	return "
	Replace(
		Replace(
			Replace(
				Replace(
					Replace(
						Replace(
							Replace(
								Replace(
									Replace(
										Replace(
											$query,'1','eins '
										),'2','zwei '
									),'3','drei '
								),'4','vier '
							),'5','fünf '
						),'6','sechs '
					),'7','sieben '
				),'8','acht '
			),'9','neun '
		),'0','null '
	)";
}


?>